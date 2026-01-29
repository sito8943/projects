<aside id="page-sidebar"
    class="flex-col gap-4 {{ !$mobile ? 'hidden sticky top-[60px]' : 'flex' }} md:flex w-full md:w-80 min-h-40 border border-gray-100 shadow-sm rounded-lg p-3 md:p-4">
    <h2 class="text-xl md:text-2xl font-bold">
        Our topics
    </h2>
    <x-tags :tags="$tags" :orientation="'vertical'"></x-tags>
</aside>