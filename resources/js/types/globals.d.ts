import { AppPageProps } from '@/types/index';

// Extend ImportMeta interface for Vite...
declare module 'vite/client' {
    interface ImportMetaEnv {
        readonly VITE_APP_NAME: string;
        [key: string]: string | boolean | undefined;
    }

    interface ImportMeta {
        readonly env: ImportMetaEnv;
        readonly glob: <T>(pattern: string) => Record<string, () => Promise<T>>;
    }
}

declare module '@inertiajs/core' {
    interface PageProps extends InertiaPageProps, AppPageProps {}
}

declare module 'vue' {
    interface ComponentCustomProperties {
        $inertia: typeof Router;
        $page: Page;
        $headManager: ReturnType<typeof createHeadManager>;
    }
}

export interface ResponseApiStudent {
    current_page: number;
    data: Student[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: Link[];
    next_page_url: any;
    path: string;
    per_page: number;
    prev_page_url: string;
    to: number;
    total: number;
}

export interface Student {
    id: number;
    nama: string;
    nim: string;
    no_hp: string;
    alamat: string;
    created_at: string;
    updated_at: string;
}

export interface Link {
    url?: string;
    label: string;
    page?: number;
    active: boolean;
}
