<?php
/**
 * Created by PhpStorm.
 * User: ANH
 * Date: 5/15/2017
 * Time: 7:31 PM
 */

function siteSettings($request)
{
    return Cache::rememberForever($request, function () use ($request) {
        $request = DB::table('sites_settings')->whereName($request)->first();
        if ($request) {
            return $request->value;
        }
        return false;
    });
}
function getMenu()
{
    return Cache::remember('menu', 100, function () {
        return DB::table('menu')->where('status', 1)->orderBy('order_by')->get();
    });
}

function getFeedBackType()
{
    return Cache::remember('feedback_type', 100, function () {
        return DB::table('feedback_type')->where('status', 1)->orderBy('id')->select('name','id')->get();
    });
}

function getBugType()
{
    return Cache::remember('feedback_bug_type', 100, function () {
        return DB::table('feedback_bug_type')->where('status', 1)->orderBy('id')->select('name','id')->get();
    });
}