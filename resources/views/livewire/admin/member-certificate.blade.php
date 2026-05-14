<div class="max-w-4xl mx-auto">
    <x-member-certificate-body
        :member="$member"
        :show-verified-badge="false"
        :show-back-button="true"
        :show-print-button="true"
        :back-url="route('admin.members')"
    />
</div>
