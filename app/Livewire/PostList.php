<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';


    public function setSort($sort)
    {
        $this->sort = ($sort == 'desc') ? 'desc' : 'asc';
        $this->resetPage();
    }

    #[On('search')]
    public function updatedSearch($search)
    {
        $this->search = $search;
        // dd($search);
    }

    #[Computed]
    public function posts()
    {
        return Post::Published()
            ->orderBy('published_at', $this->sort)
            ->where('title', 'like', "%{$this->search}%")
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.post-list',);
    }
}
