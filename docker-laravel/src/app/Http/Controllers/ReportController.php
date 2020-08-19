<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Report;

class ReportController extends Controller
{
  public function __invoke(ReportRequest $request, Report $report, $id)
  {
    // dd($request->report_arr());
    $report->create(
      $request->report_arr()
    );
    return redirect('post/' . $id)->with('my_status', __('Reported a review issue.'));
  }
}
