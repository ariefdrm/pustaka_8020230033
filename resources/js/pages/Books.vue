<script setup lang="ts">
import { Input } from '@/components/ui/input';
import {
    Pagination,
    PaginationContent,
    PaginationEllipsis,
    PaginationItem,
    PaginationNext,
    PaginationPrevious,
} from '@/components/ui/pagination';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { books } from '@/routes';
import { BreadcrumbItem } from '@/types';
import { Search } from 'lucide-vue-next';
import { onMounted, ref, watch } from 'vue';
// import {router} from "@inertiajs/vue3"
import api from '@/lib/axios';
import { ResponseApiBooks } from '@/types/globals';

const breadCrump: BreadcrumbItem[] = [
    {
        title: 'books',
        href: books.url(),
    },
];

async function fetchBooksData(page = 1, per_page = 10, title = '') {
    // Build query params so name is optional and properly encoded
    const params = new URLSearchParams();
    params.set('page', String(page));
    params.set('per_page', String(per_page));
    if (title) params.set('title', title);

    const url = `http://localhost:8000/api/books?${params.toString()}`;
    return api.get<ResponseApiBooks>(url).then((res) => res.data);
}

const data = ref<ResponseApiBooks>({
    current_page: 1,
    data: [],
    first_page_url: '',
    from: 0,
    last_page: 1,
    last_page_url: '',
    links: [],
    next_page_url: null as any,
    path: '/api/books',
    per_page: 10,
    prev_page_url: null as any,
    to: 0,
    total: 0,
} as unknown as ResponseApiBooks);

const loading = ref(false);
const error = ref('');
const page = ref(1);
const perPage = ref(10);

// search state
const search = ref('');
let searchTimeout: ReturnType<typeof setTimeout> | null = null;

const loadPage = async (p = page.value, name = search.value) => {
    loading.value = true;
    error.value = '';
    try {
        const res = await fetchBooksData(p, perPage.value, name);
        data.value = res;
        page.value = res.current_page || p;
    } catch (err: any) {
        error.value = err?.message || 'Failed to load data';
    } finally {
        loading.value = false;
    }
};

function formatDate(isoString: string) {
    const date = new Date(isoString);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

function formatLinkEdit(id: number): string {
    return `books/edit/${id}`;
}

function handleDelete(id: number) {
    api.delete(`/books/${id}`)
        .then(() => {
            loadPage();
        })
        .catch((err) => {
            console.error('Failed to delete book:', err);
        });
}

onMounted(() => loadPage());

// when page changes via pagination controls, reload
watch(page, (newPage, oldPage) => {
    if (newPage !== oldPage) loadPage(newPage);
});

// debounce search input and reset to page 1 when searching
watch(
    () => search.value,
    (val) => {
        if (searchTimeout) clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            page.value = 1;
            loadPage(1, val);
        }, 400);
    },
);
</script>

<template>
    <Head title="student-page"></Head>

    <AppLayout :breadcrumbs="breadCrump">
        <div class="flex justify-between">
            <div>
                <div class="relative m-5 w-full max-w-sm items-center">
                    <Input
                        id="search"
                        v-model="search"
                        type="text"
                        placeholder="Search by name..."
                        class="pl-10"
                    />
                    <span
                        class="absolute inset-y-0 start-0 flex items-center justify-center px-2"
                    >
                        <Search class="size-6 text-muted-foreground" />
                    </span>
                </div>
            </div>

            <button
                class="m-5 rounded bg-blue-500 px-2 py-1 text-white hover:bg-blue-600"
            >
                <a href="/books/add">Tambah data</a>
            </button>
        </div>

        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead> No </TableHead>
                    <TableHead class="w-[200px]"> Title </TableHead>
                    <TableHead>Category</TableHead>
                    <TableHead>Author</TableHead>
                    <TableHead> Publisher </TableHead>
                    <TableHead> Description </TableHead>
                    <TableHead> Created At </TableHead>
                    <TableHead> Updated At </TableHead>
                    <TableHead> </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <template v-if="loading">
                    <TableRow>
                        <TableCell :colspan="7">Loading...</TableCell>
                    </TableRow>
                </template>

                <template v-else-if="error">
                    <TableRow>
                        <TableCell :colspan="7">{{ error }}</TableCell>
                    </TableRow>
                </template>

                <template v-else-if="!data.data || data.data.length === 0">
                    <TableRow>
                        <TableCell :colspan="7">No students found.</TableCell>
                    </TableRow>
                </template>

                <TableRow
                    v-else
                    v-for="(value, index) in data.data"
                    :key="value.id"
                >
                    <TableCell>{{ (data.from || 0) + index }}</TableCell>
                    <!-- <TableCell class="font-medium">{{ value.id }}</TableCell> -->
                    <TableCell class="font-medium">{{ value.title }}</TableCell>
                    <TableCell>{{ value.category }}</TableCell>
                    <TableCell>{{ value.author }}</TableCell>
                    <TableCell> {{ value.publisher }} </TableCell>
                    <TableCell> {{ value.description }} </TableCell>
                    <TableCell>{{ formatDate(value.created_at) }}</TableCell>
                    <TableCell>{{ formatDate(value.updated_at) }}</TableCell>
                    <TableCell class="flex gap-2">
                        <button
                            class="rounded-sm bg-blue-500 px-2 py-1 text-white active:bg-blue-400"
                        >
                            <a :href="formatLinkEdit(value.id)">Edit</a>
                        </button>
                        <button
                            @click="handleDelete(value.id)"
                            class="cursor-pointer rounded-sm bg-red-500 px-2 py-1 text-white active:bg-red-400"
                        >
                            hapus
                        </button>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>

        <Pagination
            v-slot="{ page: slotPage }"
            :items-per-page="perPage"
            :total="data.total"
            :default-page="data.current_page"
        >
            <PaginationContent v-slot="{ items }">
                <PaginationPrevious
                    @click="
                        () => {
                            if (data.prev_page_url)
                                page = data.current_page - 1;
                        }
                    "
                />

                <template v-if="data.current_page === 20">
                    <PaginationItem
                        :value="data.last_page"
                        :is-active="data.last_page === slotPage"
                        @click="
                            () => {
                                page = 1;
                            }
                        "
                    >
                        {{ 1 }}
                    </PaginationItem>
                </template>

                <template v-for="(item, index) in items" :key="index">
                    <PaginationItem
                        v-if="item.type === 'page'"
                        :value="item.value"
                        :is-active="item.value === slotPage"
                        @click="
                            () => {
                                page = item.value;
                            }
                        "
                    >
                        {{ item.value }}
                    </PaginationItem>
                </template>

                <template v-if="data.current_page !== 20">
                    <PaginationEllipsis :index="5" />
                </template>

                <template v-if="data.current_page < data.last_page">
                    <PaginationItem
                        :value="data.last_page"
                        :is-active="data.last_page === slotPage"
                        @click="
                            () => {
                                page = data.last_page;
                            }
                        "
                    >
                        {{ data.last_page }}
                    </PaginationItem>
                </template>

                <PaginationNext
                    @click="
                        () => {
                            if (data.next_page_url)
                                page = data.current_page + 1;
                        }
                    "
                />
            </PaginationContent>
        </Pagination>
    </AppLayout>
</template>
