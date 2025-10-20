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
