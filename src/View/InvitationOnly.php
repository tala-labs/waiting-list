<?php

namespace ArtisanBuild\WaitingList\View;

use Illuminate\Http\Request;
use Illuminate\View\Component;

class InvitationOnly extends Component
{
    private Request $request;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if (!$this->request->hasValidSignature()) {
            return <<<'blade'
        <script>window.location.href = "{{ route('waiting_list__form') }}"</script>
    blade;
        }

        return <<<'blade'
        {** Invitation Accepted **}
    blade;
    }
}
