<?php

return [
    'payment_submitted' => 'পেমেন্ট সফলভাবে জমা দেওয়া হয়েছে!',
    'payment_approved' => 'পেমেন্ট সফলভাবে অনুমোদিত হয়েছে!',
    'payment_rejected' => 'পেমেন্ট প্রত্যাখ্যাত হয়েছে।',
    'profile_updated' => 'প্রোফাইল সফলভাবে আপডেট হয়েছে!',
    'settings_saved' => 'সেটিংস সফলভাবে সংরক্ষণ হয়েছে!',
    'member_approved' => 'সদস্যপদ সফলভাবে অনুমোদিত হয়েছে!',
    'member_rejected' => 'সদস্যপদ প্রত্যাখ্যাত হয়েছে।',
    'payment_method_added' => 'পেমেন্ট মাধ্যম যোগ করা হয়েছে!',
    'payment_method_deleted' => 'পেমেন্ট মাধ্যম মুছে ফেলা হয়েছে!',
    'payment_method_updated' => 'পেমেন্ট মাধ্যম আপডেট হয়েছে!',

    // Notifications
    'payment_approval_notification' => 'আপনার :month :year মাসের ৳:amount টাকার পেমেন্ট অনুমোদিত হয়েছে।',
    'payment_rejection_notification' => 'আপনার :month :year মাসের পেমেন্ট প্রত্যাখ্যাত হয়েছে। কারণ: :reason',
    'membership_approval_notification' => 'অভিনন্দন! আপনার সদস্যপদ অনুমোদিত হয়েছে। আপনার সদস্য নম্বর: :membership_id',
    'membership_rejection_notification' => 'দুঃখিত! আপনার সদস্যপদ আবেদন প্রত্যাখ্যাত হয়েছে। কারণ: :reason',
    'monthly_due_reminder' => 'স্মরণ: আপনার :month :year মাসের ৳:amount টাকা বকেয়া রয়েছে। দয়া করে শীঘ্রই পরিশোধ করুন।',

    // Errors
    'payment_exists' => 'এই মাসের জন্য আপনার পেমেন্ট ইতিমধ্যে জমা দেওয়া হয়েছে।',
    'payment_not_found' => 'পেমেন্ট পাওয়া যায়নি।',
    'member_not_found' => 'সদস্য পাওয়া যায়নি।',
    'invalid_credentials' => 'ভুল লগইন তথ্য।',
    'unauthorized' => 'আপনার এই কাজ করার অনুমতি নেই।',
    'receipt_only_for_approved' => 'রসিদ শুধুমাত্র অনুমোদিত পেমেন্টের জন্য পাওয়া যায়।',
    'please_provide_rejection_reason' => 'প্রত্যাখ্যানের কারণ প্রদান করুন।',
    'file_upload_failed' => 'ফাইল আপলোড ব্যর্থ হয়েছে।',
    'invalid_file_type' => 'ফাইলের ধরন সঠিক নয়।',
    'file_too_large' => 'ফাইল খুব বড়। সর্বোচ্চ :max MB অনুমোদিত।',

    // Confirmations
    'confirm_approve_payment' => 'আপনি কি এই পেমেন্ট অনুমোদন করতে চান?',
    'confirm_reject_payment' => 'আপনি কি এই পেমেন্ট প্রত্যাখ্যান করতে চান?',
    'confirm_approve_member' => 'আপনি কি এই সদস্যপদ অনুমোদন করতে চান?',
    'confirm_reject_member' => 'আপনি কি এই সদস্যপদ প্রত্যাখ্যান করতে চান?',
    'confirm_delete' => 'আপনি কি মুছে ফেলতে চান?',
    'confirm_logout' => 'আপনি কি লগআউট করতে চান?',

    // Info Messages
    'no_payments_found' => 'কোনো পেমেন্ট পাওয়া যায়নি।',
    'no_members_found' => 'কোনো সদস্য পাওয়া যায়নি।',
    'no_pending_payments' => 'কোনো অপেক্ষমাণ পেমেন্ট নেই।',
    'no_pending_registrations' => 'কোনো অপেক্ষমাণ নিবন্ধন নেই।',
    'no_transactions' => 'কোনো লেনদেন নেই।',
    'select_month_to_pay' => 'পেমেন্ট করতে মাস নির্বাচন করুন।',
    'no_unpaid_months' => 'সব মাসের পেমেন্ট জমা দেওয়া হয়েছে!',
    'current_month_unpaid' => ':month :year মাসের টাকা এখনো জমা দেওয়া হয়নি!',
    'pay_now' => 'এখনই জমা দিন',
    'first_payment_prompt' => 'প্রথম পেমেন্ট জমা দিন',

    // Status Messages
    'pending_approval' => 'অনুমোদনের অপেক্ষায়',
    'processing_request' => 'আবেদন প্রসেস হচ্ছে',
    'request_processed' => 'আবেদন প্রসেস সম্পন্ন হয়েছে',
];
