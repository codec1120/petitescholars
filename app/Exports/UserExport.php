<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{
    FromCollection,
    ShouldAutoSize,
    WithHeadings,
};

use App\Models\{User, Role};
use App\Traits\Fields\WithStaffFields;

class UserExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use WithStaffFields;

    protected array $users;
    protected $role;

    public function __construct(array $users, $role = null)
    {
        $this->users = $users;
        $this->role = $role;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $users = User::whereIn('id', $this->users)->get();

        switch ($this->role) {
            case Role::STAFF:
                return $users->transform(fn ($user) => $this->staffFields($user));
                break;
            case Role::PARENT:
                return [];
                break;
            default:
                return $users->transform(fn ($user) => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone_number' => $user->phone_number,
                    'role' => $user->role_name,
                    'learning_center' => $user->getMeta('learning_center')
                ]);
                break;
        }
    }

    public function headings(): array
    {
        switch ($this->role) {
            case Role::STAFF:
                return [
                    ...collect($this->generalInfoFields)->keys()->toArray(),
                    ...collect($this->educationInfoFields)->keys()->toArray(),
                    ...collect($this->clearancesFields)->keys()->toArray(),
                    ...collect($this->trainingFields)->keys()->toArray(),
                    ...collect($this->employmentRequirementFields)->keys()->toArray()
                ];
                break;
            case Role::PARENT:
                return [];
                break;
            default:
                return [
                    'first_name',
                    'last_name',
                    'email',
                    'phone_number',
                    'role',
                    'learning_center'
                ];
                break;
        }
    }

    // protected function mergeStaffHeaderFields(): array
    // {
    //     $firstBatch = array_merge(
    //         $this->generalInfoFields,
    //         $this->educationInfoFields
    //     );

    //     $secondBatch = array_merge(
    //         $this->clearancesFields,
    //         $this->trainingFields
    //     );

    //     $thirdBatch = array_merge($firstBatch, $secondBatch);

    //     return array_merge($this->employmentRequirementFields, $thirdBatch);
    // }

    protected function staffFields(User $user): array
    {
        $secondBatch = array_merge(
            $user->getGeneralInfo(),
            $user->getEducationInfo()
        );
        $thirdBatch = array_merge($secondBatch, $user->getClearancesInfo());
        $fourthBatch = array_merge($thirdBatch, $user->getTrainingInfo());
        $fifthBatch = array_merge($fourthBatch, $user->getEmploymentRequirementsInfo());

        return $fifthBatch;
    }
}
