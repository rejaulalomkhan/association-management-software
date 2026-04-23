<?php

namespace App\Livewire\Admin;

use Livewire\Component;

/**
 * Product roadmap / "Smart Plan" page.
 *
 * Lists every payment-related module we want to expose in the future
 * (monthly toggle, registration fee, renewal, events, yearly, etc.)
 * together with its current status. This is the single place the admin
 * can look at to see what is already live vs. planned.
 *
 * The actual implementation details live in docs/payment-modules-roadmap.md
 * — this page simply surfaces a friendly summary inside the admin panel.
 */
class Roadmap extends Component
{
    /**
     * Category filter for the roadmap grid.
     * Values: 'all' | 'done' | 'planned' | 'in_progress'
     */
    public string $filter = 'all';

    public function setFilter(string $filter): void
    {
        $this->filter = in_array($filter, ['all', 'done', 'planned', 'in_progress'], true)
            ? $filter
            : 'all';
    }

    /**
     * The source of truth for what shows up on the page.
     *
     * status:
     *   - done         → already shipped
     *   - in_progress  → partially built / being worked on
     *   - planned      → future work, not started yet
     */
    private function features(): array
    {
        return [
            // ───── Payment core ─────
            [
                'group' => 'পেমেন্ট কোর',
                'title' => 'মাসিক ফি (ডিফল্ট এমাউন্ট)',
                'description' => 'সকল সদস্যের জন্য সেটিংস থেকে একটি ডিফল্ট মাসিক ফি নির্ধারণ করা যায়।',
                'status' => 'done',
                'icon' => 'currency-dollar',
            ],
            [
                'group' => 'পেমেন্ট কোর',
                'title' => 'প্রতি-সদস্য কাস্টম মাসিক ফি',
                'description' => 'যেকোনো সদস্যের প্রোফাইলে আলাদা ফি বসানো যায়। কাস্টম ফি থাকলে সেটাই সর্বত্র কার্যকর হয় — পেমেন্ট ফর্ম, বকেয়া হিসাব, WhatsApp মেসেজ সহ।',
                'status' => 'done',
                'icon' => 'user-circle',
            ],
            [
                'group' => 'পেমেন্ট কোর',
                'title' => 'মাসিক পেমেন্ট মডিউল চালু/বন্ধ টগল',
                'description' => 'সেটিংস থেকে পুরো মাসিক পেমেন্ট মডিউলটি চালু/বন্ধ করা যাবে — যেসব প্রতিষ্ঠানের মাসিক চাঁদা লাগে না তাদের জন্য।',
                'status' => 'planned',
                'icon' => 'power',
            ],

            // ───── Fee types ─────
            [
                'group' => 'ফি টাইপ',
                'title' => 'রেজিস্ট্রেশন / ভর্তি ফি',
                'description' => 'সদস্য ফর্ম জমা দেয়ার সময় এককালীন ফি — admin সেটিংস থেকে নিয়ন্ত্রিত, প্রতি সদস্য override সাপোর্ট সহ।',
                'status' => 'planned',
                'icon' => 'clipboard-check',
            ],
            [
                'group' => 'ফি টাইপ',
                'title' => 'সদস্য পদ রিনিউ ফি',
                'description' => 'প্রতি বছর/সাইকেলে সদস্য পদ রিনিউ করার জন্য আলাদা ফি, রিমাইন্ডার সহ।',
                'status' => 'planned',
                'icon' => 'refresh',
            ],
            [
                'group' => 'ফি টাইপ',
                'title' => 'বাৎসরিক চাঁদা (টার্ম সিলেকশন)',
                'description' => 'সেটিংস থেকে মাসিক অথবা বাৎসরিক ডিফল্ট টার্ম। প্রতি সদস্যে override সম্ভব। বাৎসরিক সদস্যরা মাসিক বকেয়া লিস্টে আসেন না — তাদের জন্য আলাদা বছরভিত্তিক পেমেন্ট UI।',
                'status' => 'done',
                'icon' => 'calendar',
            ],
            [
                'group' => 'ফি টাইপ',
                'title' => 'ইভেন্ট / অনুষ্ঠান ফি',
                'description' => 'প্রতিটি ইভেন্টের জন্য একটি ফি প্রজেক্ট তৈরি করে নির্দিষ্ট সদস্যদের থেকে সংগ্রহ করা, আলাদা ট্র্যাকিং সহ।',
                'status' => 'planned',
                'icon' => 'sparkles',
            ],

            // ───── Communication ─────
            [
                'group' => 'যোগাযোগ',
                'title' => 'WhatsApp বকেয়া রিমাইন্ডার',
                'description' => 'সদস্যের কাস্টম/ডিফল্ট ফি, চলতি বকেয়া ও মাস সংখ্যা সহ এক ক্লিকে WhatsApp মেসেজ।',
                'status' => 'done',
                'icon' => 'chat',
            ],
            [
                'group' => 'যোগাযোগ',
                'title' => 'অটো রিমাইন্ডার (বাল্ক)',
                'description' => 'নির্ধারিত তারিখে সব বকেয়াদার সদস্যকে একসাথে WhatsApp/SMS রিমাইন্ডার পাঠানোর সিস্টেম।',
                'status' => 'planned',
                'icon' => 'mail',
            ],

            // ───── Member management ─────
            [
                'group' => 'সদস্য ব্যবস্থাপনা',
                'title' => 'QR কোড ভেরিফিকেশন',
                'description' => 'প্রতি সদস্যের ইউনিক QR কোড, স্কেন করলে পাবলিক ভেরিফিকেশন পেজ খুলবে।',
                'status' => 'done',
                'icon' => 'qrcode',
            ],
            [
                'group' => 'সদস্য ব্যবস্থাপনা',
                'title' => 'রেজিস্ট্রেশন শর্তাবলী কন্ট্রোল',
                'description' => 'সেটিংস থেকে রেজিস্ট্রেশন পেজের শর্তাবলী সম্পূর্ণ কাস্টমাইজ করা যায়।',
                'status' => 'done',
                'icon' => 'document-text',
            ],
        ];
    }

    public function render()
    {
        $features = collect($this->features());

        if ($this->filter !== 'all') {
            $features = $features->where('status', $this->filter);
        }

        $counts = [
            'done'        => collect($this->features())->where('status', 'done')->count(),
            'in_progress' => collect($this->features())->where('status', 'in_progress')->count(),
            'planned'     => collect($this->features())->where('status', 'planned')->count(),
            'all'         => count($this->features()),
        ];

        return view('livewire.admin.roadmap', [
            'features' => $features->groupBy('group'),
            'counts'   => $counts,
        ])->layout('layouts.app');
    }
}
