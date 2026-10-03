<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /** Siapa saja boleh melihat daftar & detail post */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /** Semua user login boleh membuat post */
    public function create(User $user): bool
    {
        return true;
    }

    /** Hanya pemilik post atau editor/admin yang boleh mengedit */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || in_array($user->role, ['editor', 'admin'], true);
    }

    /** Hanya pemilik post atau admin yang boleh menghapus */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || $user->role === 'admin';
    }
}
