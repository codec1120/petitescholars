<?php

namespace App\Http\Livewire;

use Livewire\Component;

use \Illuminate\Session\SessionManager;

use Asantibanez\LivewireCharts\Models\{
    AreaChartModel,
    ColumnChartModel,
    LineChartModel,
    PieChartModel
};

use App\Traits\{
    ChildrenViewData,
    DashboardData,
    AdobeSign
};

use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    use ChildrenViewData, DashboardData, AdobeSign;

    public $totalUsers = 0;
    public $totalStaff = 0;
    public $totalStaffWithMissingDocuementation = 0;
    public $totalStaffWithCompleteDocumentation = 0;
    public $totalChildren = 0;
    public $totalChildrenWithMissingDocuementation = 0;
    public $totalChildrenWithCompleteDocumentation = 0;

    public function mount (SessionManager $session)
    {
        if (Auth::user()->role === "parent") {
            return redirect()->route('children', ['user' => Auth()->user()->id]);
        }
    }

    public function atGlance () : array {
        $userCnt = $this->getTotalUsers();

        $columnChartModel =
        (new ColumnChartModel())
            ->setTitle('Users')
            ->addColumn('Staff', intval( $userCnt['staffCnt'] ), '#f6ad55')
            ->addColumn('Parents', intval( $userCnt['parentCnt'] ), '#fc8181')
            ->addColumn('Children', intval( $userCnt['childrenCnt'] ), '#90cdf4')
        ;

        $this->totalUsers =  intval( $userCnt['staffCnt'] ) + intval( $userCnt['parentCnt'] ) + intval( $userCnt['childrenCnt'] );
        return [
            'columnChartModel' => $columnChartModel,
        ];
    }

    public function render()
    {
        return view('livewire.dashboard', $this->atGlance() );
    }
}
