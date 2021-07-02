<?php

namespace App\Http\Controllers\Page;

use App\Page;
use App\Project;
use App\ProjectCategory;
use App\Http\Controllers\Controller;
use App\Partner;
use App\Team;


/**
 * Class ProjectsController
 *
 * @package App\Http\Controllers\Page
 */
class ProjectsController extends Controller
{
    /**
     * View projects.
     *
     * @param Page $page
     * @param $view
     * @return \Illuminate\Http\Response
     */
    public function index(Page $page, string $view)
    {
        $projects = Project::with(
            'images',
            'categories.translation'
        )
            ->active()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        $categories = ProjectCategory::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        $partners = Partner::active()
            ->orderBy('order', 'asc')
            ->get();
        
        $teams = Team::active()
            ->translated()
            ->withTranslation()
            ->whereIsAboutUs(true)
            ->orderBy('order')
            ->get();

        return view($view)->with(compact('page', 'projects', 'categories', 'partners', 'teams'));
    }

    /**
     * View project.
     *
     * @param Page $page
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page, Project $project)
    {
        $project->load('images', 'categories.translation');

        $prev = Project::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'desc')
            ->where('id', '<', $project->id)
            ->limit(1)
            ->first();

        $next = Project::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'asc')
            ->where('id', '>', $project->id)
            ->limit(1)
            ->first();

        $ids = [$project->id];

        if ($prev) {
            array_push($ids, $prev->id);
        }

        if ($next) {
            array_push($ids, $next->id);
        }

        $related = Project::active()
            ->with(
                'images',
                'categories.translation'
            )
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'asc')
            ->whereNotIn('id', $ids)
            ->limit(3)
            ->get();
        
        $projects = Project::with(
            'images',
            'categories.translation'
            )
            ->active()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        $partners = Partner::active()
            ->orderBy('order', 'asc')
            ->get();
        
        $teams = Team::active()
            ->translated()
            ->withTranslation()
            ->whereIsAboutUs(true)
            ->orderBy('order')
            ->get();

        return view('projects.view', compact('page', 'prev', 'next', 'project', 'related', 'partners', 'projects', 'teams'));
    }
}
