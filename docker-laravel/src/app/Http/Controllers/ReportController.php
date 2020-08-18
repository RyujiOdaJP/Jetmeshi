<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Report;
use App\Post;

class ReportController extends Controller
{
  public function __invoke(ReportRequest $request, Report $report, Post $post)
  {
    $report->save(
      $request->report_arr()
    );
    return redirect('post/' . $post->id)->with('my_status', __('Reported a review issue.'));
  }
}
