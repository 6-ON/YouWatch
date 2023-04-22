export { }
declare global {
    interface User {
        id: number;
        name: string;
        username: string;
        email: string;
        subscribers_count: number;
        image: string;
        email_verified_at?: string;
        isAdmin: number;
        is_subscribed_to: boolean|undefined;
        created_at?: string;
        updated_at?: string;
    }
    interface TEdit {
        [key: string]: any
        name?: string
        email?: string
        password?: string
        image?: null
    }
    interface CommentT {
        id?: number;
        body: string;
        user: User;
        created_at: string;
        updated_at?: string;
    }
    interface Video {
        id: number;
        user_id: number;
        title: string;
        description: string;
        duration: string;
        url: string;
        thumbnail_url: string;
        created_at: string;
        updated_at: string;
        likes_count: number;
        comments_count: number;
        views_count: number;
        banned_at: string | null;
        user: User;
        user_reaction: {
            isLiked: number;
        }|null;
        tags: {
            id: number;
            name: {
                en: string;
            };
            slug: {
                en: string;
            };
            type: null;

            order_column: number;
            created_at: string;
            updated_at: string;
            pivot: {
                taggable_id: number;
                tag_id: number;
                taggable_type: string;
            };
        }[];
        comments?: CommentT[];
    }
    interface VideoList {
        data: Video[],
        first_page_url: string,
        from: number,
        last_page: number,
        last_page_url: string,
        links: {
            url: string | null,
            label: string,
            active: boolean
        }[],
        next_page_url: string | null,
        path: string,
        per_page: number,
        prev_page_url: string | null,
        to: number,
        total: number
    }
}