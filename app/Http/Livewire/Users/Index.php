<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Illuminate\Session\SessionManager;

use App\Models\{User, Role};
use App\Exports\UserExport;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPerPagePagination;
    use WithSorting;
    use WithCachedRows;
    use WithBulkActions;
    use AuthorizesRequests;

    public $role;
    public $search;
    public $backToUser;

    public $showDeleteModal = false;
    public $onlyTrashed = false;

    protected $queryString = ['search', 'role', 'backToUser'];

    public function mount( SessionManager $session)
    { 
        if ( $this->backToUser ) {

            $session->put( 'add_back_to_user_page', false );

            Auth::loginUsingId(  $session->get( 'from_user_id' ) );

            $session->put( 'from_user_id', null );

            redirect()->route('users.index');
        }
        
        if (Auth()->user()->role == 'parent') {
            return redirect()->route('children', ['user' => Auth()->user()->id]);
        } else {
            $this->authorize('viewAny', Auth::user());
        }
    }

    public function getRowsQueryProperty()
    {
        return User::whereIn( 'role', $this->role == 'staff' ? [ $this->role, 'admin' ] :[ 'staff', 'admin', 'parent' ])
            ->search($this->search)
            ->when(
                $this->onlyTrashed,
                fn ($query)  => $query->onlyTrashed()
            )
            ->orderBy('first_name');
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function goToProfile(User $user)
    {
        return redirect()->route('staffs.profile.general', $user);
    }

    public function export()
    {
        $users = collect($this->selected);

        if ($users->isEmpty()) {
            $this->notify('warning', 'You must select users to export!');

            return;
        }

        $filename = "users/spreadsheets/Petite_Scholars_Users.csv";

        if (Storage::disk('spaces')->has($filename)) {
            Storage::disk('spaces')->delete($filename);
        }

        Excel::store(
            new UserExport($users->toArray(), $this->role),
            $filename,
            'spaces',
            null
        );

        $this->selected = [];
        $this->selectPage = false;

        return Storage::disk('spaces')->download($filename);
    }

    public function loginAs($userId, SessionManager $session)
    {
        $session->put( 'from_user_id', Auth::user()->id );
        
        Auth::loginUsingId($userId);

        $session->put( 'add_back_to_user_page', true );

        if ( Auth::user()->role === 'staff') {
            return redirect()->route('profile.show', Auth()->user());
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function restoreOrDelete(int $id, $action)
    {
        $user = User::withTrashed()->find($id);
        $message = '';

        if ($action === 'restore') {
            $user->restore();
            $message = "{$user->full_name} restored!";
        } else {
            $user->forceDelete();
            $message = "{$user->full_name} permanently deleted!";
        }

        $this->notify('success', $message);
    }

    protected function getTitle(): string
    {
        return $this->role === Role::STAFF ? 'Staff' : 'User';
    }

    protected function data(): array
    {
        return [
            'users' => $this->rows,
            'title' => $this->getTitle()
        ];
    }


    public function render()
    {
        return view(
            'livewire.users.index',
            $this->data()
        )->layout('layouts.base');
    }
}
