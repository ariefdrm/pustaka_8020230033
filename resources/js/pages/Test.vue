<script setup lang="ts">
import {
    Pagination,
    PaginationContent,
    PaginationEllipsis,
    PaginationItem,
    PaginationNext,
    PaginationPrevious,
} from '@/components/ui/pagination';
import {
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { ResponseApiStudent } from '@/types/globals';
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { route } from 'ziggy-js';

type Tfilter = {
    search?: any;
};

const props = defineProps<{
    students: ResponseApiStudent;
    filters: Tfilter;
}>();
console.log(props.students.next_page_url);
console.log(props.students.links);

const search = ref(props.filters.search || '');

/**
 * Navigate using either a paginator URL (next_page_url / prev_page_url)
 * or a numeric page. When given a URL we parse its query params and
 * call the Inertia route with those params so the backend receives
 * the same query (search, page, per_page, etc.).
 */
const navigateTo = (urlOrPage?: string | number) => {
    const opts = { preserveState: true, replace: true };

    if (!urlOrPage) return;

    if (typeof urlOrPage === 'number') {
        router.get(
            route('page2.index'),
            { search: search.value, page: urlOrPage },
            opts,
        );
        return;
    }

    try {
        const parsed = new URL(urlOrPage, window.location.origin);
        const paramsObj: Record<string, any> = {};
        parsed.searchParams.forEach((value, key) => {
            paramsObj[key] = value;
        });

        // Ensure search param falls back to current search state
        if (!paramsObj.search) paramsObj.search = search.value;

        router.get(route('page2.index'), paramsObj, opts);
    } catch {
        // if URL parsing fails, try treating as page number
        const p = Number(urlOrPage as any);
        if (!Number.isNaN(p))
            router.get(
                route('page2.index'),
                { search: search.value, page: p },
                opts,
            );
    }
};

watch(search, (value) => {
    router.get(
        route('page2.index'),
        { search: value, page: 1 },
        { preserveState: true, replace: true },
    );
});
</script>

<template>
    <AppLayout>
        <form>
            <input
                v-model="search"
                type="text"
                placeholder="Search... "
                name="search"
            />
        </form>

        <div class="w-full">
            <table class="border-separate border-white">
                <TableHeader>
                    <TableRow>
                        <TableHead>No</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Nim</TableHead>
                        <TableHead>Alamat</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow
                        v-for="(value, index) in props.students.data"
                        :key="value.id"
                    >
                        <TableCell>{{
                            (props.students.from || 0) + index
                        }}</TableCell>
                        <TableCell>{{ value.nama }}</TableCell>
                        <TableCell>{{ value.nim }}</TableCell>
                        <TableCell>{{ value.alamat }}</TableCell>
                    </TableRow>
                </TableBody>
            </table>
        </div>

        <Pagination
            v-slot="{ page }"
            :items-per-page="props.students.per_page"
            :total="props.students.total"
            :default-page="props.students.current_page"
        >
            <PaginationContent v-slot="{ items }">
                <PaginationPrevious
                    @click="
                        () =>
                            navigateTo(
                                props.students.prev_page_url ||
                                    props.students.current_page - 1,
                            )
                    "
                />

                <template v-for="(item, index) in items" :key="index">
                    <PaginationItem
                        v-if="item.type === 'page'"
                        :value="item.value"
                        :is-active="item.value === page"
                        @click="
                            () =>
                                router.get(
                                    route('page2.index'),
                                    { search: search, page: item.value },
                                    { preserveState: true, replace: true },
                                )
                        "
                    >
                        {{ item.value }}
                    </PaginationItem>
                </template>

                <PaginationEllipsis :index="4" />

                <PaginationNext
                    @click="
                        () =>
                            navigateTo(
                                props.students.next_page_url ||
                                    props.students.current_page + 1,
                            )
                    "
                />
            </PaginationContent>
        </Pagination>
    </AppLayout>
</template>
