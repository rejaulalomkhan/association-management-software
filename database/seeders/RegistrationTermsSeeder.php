<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class RegistrationTermsSeeder extends Seeder
{
    /**
     * Seed a default "Terms and Conditions" block for the public registration page.
     *
     * The stored value is raw HTML. Admin can edit it from
     * /admin/settings → "শর্তাবলী" tab. Any occurrence of {org_name}
     * is replaced by the organization name at render time, so the
     * terms stay in sync if the org name is changed later.
     */
    public function run(): void
    {
        $defaultHtml = <<<'HTML'
<h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">১. সাধারণ শর্তাবলী</h3>
<p class="text-gray-700 dark:text-gray-300 mb-4">
    {org_name}-এ সদস্য হিসেবে নিবন্ধন করার মাধ্যমে আপনি নিম্নলিখিত শর্তাবলী মেনে নিতে সম্মত হচ্ছেন।
    এই শর্তাবলী সংগঠনের নিয়ম-কানুন এবং আপনার দায়িত্ব ও অধিকার নির্ধারণ করে।
</p>

<h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">২. সদস্যপদের যোগ্যতা</h3>
<ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-4 space-y-2">
    <li>আবেদনকারীকে অবশ্যই বাংলাদেশী নাগরিক হতে হবে</li>
    <li>ন্যূনতম বয়স ১৮ বছর হতে হবে</li>
    <li>সকল তথ্য সঠিক এবং সত্য হতে হবে</li>
    <li>সংগঠনের উদ্দেশ্য ও লক্ষ্যের সাথে একমত হতে হবে</li>
</ul>

<h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">৩. সদস্যের দায়িত্ব</h3>
<ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-4 space-y-2">
    <li>সংগঠনের নিয়ম-কানুন মেনে চলা</li>
    <li>সংগঠনের কার্যক্রমে সক্রিয় অংশগ্রহণ করা</li>
    <li>সংগঠনের সুনাম রক্ষা করা</li>
    <li>নির্ধারিত সদস্য ফি যথাসময়ে পরিশোধ করা</li>
    <li>প্রদত্ত তথ্য হালনাগাদ রাখা</li>
</ul>

<h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">৪. গোপনীয়তা নীতি</h3>
<p class="text-gray-700 dark:text-gray-300 mb-4">
    আপনার ব্যক্তিগত তথ্য সম্পূর্ণ গোপনীয় রাখা হবে এবং শুধুমাত্র সংগঠনের অভ্যন্তরীণ কাজে ব্যবহার করা হবে।
    আপনার অনুমতি ছাড়া কোনো তথ্য তৃতীয় পক্ষের সাথে শেয়ার করা হবে না।
</p>

<h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">৫. সদস্যপদ বাতিল</h3>
<p class="text-gray-700 dark:text-gray-300 mb-4">
    সংগঠনের নিয়ম লঙ্ঘন, মিথ্যা তথ্য প্রদান, বা সংগঠনের সুনাম ক্ষুণ্ণ করার মতো কাজের জন্য
    প্রশাসন যে কোনো সময় সদস্যপদ বাতিল করার অধিকার সংরক্ষণ করে।
</p>

<h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">৬. অনুমোদন প্রক্রিয়া</h3>
<p class="text-gray-700 dark:text-gray-300 mb-4">
    নিবন্ধন আবেদন জমা দেওয়ার পর প্রশাসন আপনার তথ্য যাচাই করবে। অনুমোদন পেতে ৭-১৫ কার্যদিবস সময় লাগতে পারে।
    অনুমোদনের পর আপনি ইমেইল/ফোনে বিজ্ঞপ্তি পাবেন।
</p>
HTML;

        Setting::firstOrCreate(
            ['key' => 'registration_terms'],
            ['value' => $defaultHtml]
        );

        Setting::firstOrCreate(
            ['key' => 'registration_terms_acceptance_label'],
            ['value' => 'আমি উপরের সকল শর্তাবলী পড়েছি এবং সম্মত হয়েছি। আমি নিশ্চিত করছি যে আমার প্রদত্ত সকল তথ্য সঠিক এবং সত্য।']
        );
    }
}
