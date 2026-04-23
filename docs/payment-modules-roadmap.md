# Payment Modules — Roadmap / Smart Plan

এই ডকুমেন্টটি প্রজন্ম (Projonmo) অ্যাপের পেমেন্ট-সংক্রান্ত সকল মডিউলের বর্তমান অবস্থা এবং ভবিষ্যৎ পরিকল্পনার একক উৎস (source of truth)। এডমিন প্যানেলে `/admin/roadmap` পেজটি এই ডকের সারসংক্ষেপ দেখায়।

---

## 1. বর্তমান অবস্থা (Implemented)

### 1.1 Default Monthly Fee
- সেটিংসের `monthly_fee` কী থেকে সকল সদস্যের জন্য একটি ডিফল্ট মাসিক ফি নির্ধারিত হয়।
- স্থানসমূহ: `SettingsService::getMonthlyFee()`, admin Settings পেজ।

### 1.2 Per-Member Custom Monthly Fee ✅ NEW
- `users.monthly_fee` (nullable decimal) কলাম — যদি NULL হয়, ডিফল্ট কার্যকর; অন্যথায় সদস্যের নিজস্ব ফি কার্যকর।
- এন্ট্রি পয়েন্ট: `App\Models\User::effectiveMonthlyFee()`
- Helper: `org_monthly_fee($user)` (global)
- স্বয়ংক্রিয়ভাবে ব্যবহার হয়:
    - `MemberService::calculateOutstandingDues()`
    - `MemberService::getUnpaidMonths()`
    - `SubmitPayment::updatePaymentAmount()`, `submitPayment()`, `getTotalOverdueInfo()`
    - WhatsApp রিমাইন্ডার লিংক (admin view-member-profile)
- UI: `/admin/members/view/{id}` পেজে "মাসিক ফি" কার্ড — edit/reset।

### 1.3 QR Code Verification
- প্রতি সদস্যের ইউনিক `verification_token` — `/verify/{token}` পাবলিক রুট।

### 1.4 Registration Terms Settings
- এডমিন সেটিংসের "শর্তাবলী" ট্যাব থেকে রেজিস্ট্রেশন পেজের টেক্সট সম্পূর্ণ কন্ট্রোল।

### 1.5 Enhanced WhatsApp Reminder
- Admin member profile → WhatsApp বোতাম ক্লিক করলে মেসেজে আসে: সদস্যের নাম, প্রতিষ্ঠানের নাম, effective monthly fee (কাস্টম badge সহ), বর্তমান বকেয়া।

---

## 2. পরবর্তী ফিচার (Planned)

### 2.1 Monthly Module Toggle
**Goal:** এডমিন সেটিংস থেকে পুরো মাসিক পেমেন্ট মডিউলটি On/Off করা যাবে।

**Why:** সকল প্রতিষ্ঠানের মাসিক চাঁদা লাগে না। কারো শুধু registration fee, কারো event-based, কারো yearly।

**Data model:**
```
settings.monthly_payment_enabled  boolean  default true
```

**UI touch-points (when disabled):**
- সাইডবার থেকে "টাকা জমা দেয়া" লিংক hide (member side)
- `/member/payment` পেজ redirect/disabled screen
- `DuePaymentCard` component hide
- Admin dashboard থেকে "মাসিক বকেয়া" স্ট্যাটস hide
- Admin `view-member-profile` → Custom Fee কার্ড hide

**Helper:** `monthly_payments_enabled(): bool`

**Blade guard pattern:**
```blade
@if(monthly_payments_enabled())
    <livewire:member.due-payment-card />
@endif
```

---

### 2.2 Registration / Admission Fee
**Goal:** সদস্য ফর্ম জমা দেয়ার সময় এককালীন একটি ফি — admin approval-এর আগে বা পরে পরিশোধযোগ্য।

**Data model:**
```
settings.registration_fee              decimal  default 0
settings.registration_fee_required     boolean  default false
users.registration_fee_paid_at         datetime nullable
users.registration_fee_amount          decimal  nullable  -- per-member override
payments.type                          enum('monthly','registration','renewal','event','yearly')
```

**Flow:**
1. নতুন রেজিস্ট্রেশনে `registration_fee_required=true` হলে সদস্যকে payment proof আপলোডের পেজে redirect।
2. Admin approval-এর সময় `registration_fee_paid_at` check।
3. Accountant আলাদাভাবে approve করবেন → পরে status `active`।

**Helper:** `User::effectiveRegistrationFee()`.

---

### 2.3 Membership Renewal Fee
**Goal:** প্রতি বছর/সাইকেলে সদস্য পদ রিনিউ করার ফি + রিমাইন্ডার।

**Data model:**
```
settings.renewal_fee                decimal  default 0
settings.renewal_interval_months    int      default 12
users.last_renewed_at               datetime nullable
users.renewal_fee_amount            decimal  nullable
```

**Jobs:**
- Daily scheduled job — expired সদস্যদের flag করা + WhatsApp রিমাইন্ডার।

---

### 2.4 Yearly Fee
**Goal:** মাসিকের বিকল্প হিসেবে বাৎসরিক ফি কালেকশন।

**Pattern:** Monthly-এর মতোই — `settings.yearly_fee`, `users.yearly_fee`, `payments.type='yearly'`, ইউনিট month-এর বদলে year।

Either-or switch:
```
settings.billing_cycle  enum('monthly','yearly','none')  default 'monthly'
```

---

### 2.5 Event / Program Fee
**Goal:** নির্দিষ্ট ইভেন্টের জন্য ফি কালেকশন প্রজেক্ট তৈরি + নির্দিষ্ট সদস্যদের থেকে সংগ্রহ।

**Data model:**
```
events                id, title, amount, deadline_at, created_by
event_payments        id, event_id, user_id, amount, status, payment_id (FK payments)
```

**UI:**
- Admin → "ইভেন্ট ফি" পেজ → Create event, select participants.
- Member → "চলমান ইভেন্ট" widget, one-click pay.

---

### 2.6 Bulk Reminder (WhatsApp / SMS)
**Goal:** এক ক্লিকে সব বকেয়াদার সদস্যকে রিমাইন্ডার।

**Constraints:**
- WhatsApp Business API বা wa.me fallback (ব্রাউজারে একটি একটি করে)।
- Template message সিস্টেম — `{name}`, `{fee}`, `{due}`, `{months}` placeholders।

**Table:**
```
reminder_logs  id, user_id, channel(whatsapp|sms), template, sent_at, sent_by
```

---

## 3. Architecture Principles

1. **Single override rule:** যেকোনো fee-সংক্রান্ত ফিল্ড — per-member column হলে default-এর চেয়ে সর্বদা preference পাবে।
2. **Helper-first:** Blade views/Livewire components কখনো সরাসরি settings read করবে না। সর্বদা `org_*()` helper বা model method ব্যবহার করবে।
3. **Idempotent seeders:** সকল seeder `firstOrCreate` / `updateOrInsert` ব্যবহার করবে।
4. **Feature toggles first:** নতুন কোনো মডিউল যোগ করার আগে settings-এ তার toggle থাকতে হবে।

---

## 4. Reference Files

- `app/Models/User.php` — `effectiveMonthlyFee()`, `hasCustomMonthlyFee()`
- `app/Services/MemberService.php` — dues calculation
- `app/Services/SettingsService.php` — setting reads/writes
- `app/Helpers/helpers.php` — `org_*` globals
- `app/Livewire/Admin/Roadmap.php` — this roadmap page
- `database/migrations/2026_04_23_120000_add_monthly_fee_to_users_table.php`
