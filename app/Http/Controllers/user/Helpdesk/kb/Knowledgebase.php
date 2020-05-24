<?php

namespace App\Http\Controllers\user\Helpdesk\kb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\user\Helpdesk\kb\ArticleRequest;
use App\Http\Requests\user\Helpdesk\kb\ArticleUpdate;
// Models
use App\Models\Helpdesk\kb\Article;
use App\Models\Helpdesk\kb\Category;
use App\Models\Helpdesk\kb\Comment;
use App\Models\Helpdesk\kb\Relationship;
use App\Models\Helpdesk\kb\Settings;
// Classes
use Auth;
use Datatables;
use DB;
use Exception;

use Lang;
use Redirect;
use App\Http\Controllers\user\UserAdminController;
use Session;

class Knowledgebase extends UserAdminController
{
      
    public function data()
    {

        /* fetching chumper datatables */
        $articles  = new Article();
        $articles = $articles->select('id', 'name', 'description', 'publish_time', 'slug')->orderBy('publish_time', 'desc')->get();
        // dd($articles);
        return Datatables::of($articles)

                        ->remove_column('id')
                        ->remove_column('description')
                        ->remove_column('slug')
    //                     /* add column name */
                        ->editColumn('name', function ($model) {
                            $name = str_limit($model->name, 20, '...');

                            return "<p title=$model->name>$name</p>";
                        })
    //                     /* add column Created */
    //                     ->addColumn('publish_time', function ($model) {
    //                         $t = $model->publish_time;

    //                         return $t;
    //                     })
    //                     /* add column action */
    ->addColumn('action', function ($model) {
                    return ' <a class="btn btn-xs btn-success" href="'.url('admin/helpdesk/kb/article/'.$model->id.'/view/').'/">view</a>&nbsp;
                    <a class="btn btn-xs btn-success" href="'.url('admin/helpdesk/kb/article/'.$model->id.'/edit/').'/">Edit</a>
                                    &nbsp;
                                    <button class="btn btn-warning btn-info btn-xs btn-delete-kb-article" data-id="'.$model->slug.'"> delete </button>';
                })
    //                     ->searchColumns('name', 'description', 'publish_time')
    //                     ->orderColumns('name', 'description', 'publish_time')
                        ->escapeColumns([])
                        ->make();
    }

    /**
     * List of Articles.
     *
     * @return type view
     */
    public function index()
    {
         $title     = trans('kb.articles');
        $sub_title = trans('kb.articles');
        $base      = trans('kb.articles');
        $method    = trans('kb.articles');
        $category  = new Category();
        $category  = Category::pluck('name', 'id')->toArray();
        /* show article list */
        try {
             return view('app.user.helpdesk.kb.article.index',compact('title','sub_title','base','method','category'));
        } catch (Exception $e) {
            return redirect()->back()->with('fails', $e->getMessage());
        }
    }


    /**
     * Insert the values to the article.
     *
     * @param type Article        $article
     * @param type ArticleRequest $request
     *
     * @return type redirect
     */
    public function store(Article $article, ArticleRequest $request)
    {
        // requesting the values to store article data
        $publishTime = $request->input('year').'-'.$request->input('month').'-'.$request->input('day').' '.$request->input('hour').':'.$request->input('minute').':00';

        $sl = $request->input('name');
        $slug = str_slug($sl, '-');
        $article->slug = $slug;
        $article->publish_time = $publishTime;
        $article->fill($request->except('created_at', 'slug'))->save();
        // creating article category relationship
        $requests = $request->input('category_id');
        $id = $article->id;

        foreach ($requests as $req) {
            DB::insert('insert into kb_article_relationship (category_id, article_id) values (?,?)', [$req, $id]);
        }
        /* insert the values to the article table  */
        try {
            $article->fill($request->except('slug'))->save();
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('kb.article_inserted_successfully')));
            return redirect('admin/helpdesk/kb/article');
        } catch (Exception $e) {
             Session::flash('flash_notification', array('level' => 'success', 'message' => trans('kb.couldnt_add_article'.'<li>'.$e->getMessage().'</li>')));
            return redirect('admin/helpdesk/kb/article');
        }
    }

    /**
     * Edit an Article by id.
     *
     * @param type Integer      $id
     * @param type Article      $article
     * @param type Relationship $relation
     * @param type Category     $category
     *
     * @return view
     */
    public function edit($slug)
    {

        $title     = trans('kb.edit_article');
        $sub_title = trans('kb.edit_article');
        $base      = trans('kb.edit_article');
        $method    = trans('kb.edit_article');

        $article = new Article();
        $relation = new Relationship();
        $category = new Category();
        $aid = $article->where('id', $slug)->first();
        $id = $aid->id;
        /* define the selected fields */
        $assign = $relation->where('article_id', $id)->pluck('category_id');
        /* get the attributes of the category */
        $category = $category->pluck('id', 'name');
        /* get the selected article and display it at edit page  */
        /* Get the selected article with id */
        $article = $article->whereId($id)->first();
        /* send to the edit page */
        try {
            return view('app.admin.helpdesk.kb.article.edit', compact('assign', 'article', 'category','title','sub_title','base','method'));
        } catch (Exception $e) {
            return redirect()->back()->with('fails', $e->getMessage());
        }
    }

    /**
     * Update an Artile by id.
     *
     * @param type Integer        $id
     * @param type Article        $article
     * @param type Relationship   $relation
     * @param type ArticleRequest $request
     *
     * @return Response
     */
    public function update($slug, ArticleUpdate $request)
    {
        $article = new Article();
        $relation = new Relationship();
        $aid = $article->where('id', $slug)->first();
        $publishTime = $request->input('year').'-'.$request->input('month').'-'.$request->input('day').' '.$request->input('hour').':'.$request->input('minute').':00';

        $id = $aid->id;
        $sl = $request->input('slug');
        $slug = str_slug($sl, '-');
        // dd($slug);

        $article->slug = $slug;
        /* get the attribute of relation table where id==$id */
        $relation = $relation->where('article_id', $id);
        $relation->delete();
        /* get the request of the current articles */
        $article = $article->whereId($id)->first();
        $requests = $request->input('category_id');
        $id = $article->id;
        foreach ($requests as $req) {
            DB::insert('insert into kb_article_relationship (category_id, article_id) values (?,?)', [$req, $id]);
        }
        /* update the value to the table */
        try {
            $article->fill($request->all())->save();
            $article->slug = $slug;
            $article->publish_time = $publishTime;
            $article->save();
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('kb.article_updated_successfully')));

            return redirect()->back();
        } catch (Exception $e) {
             Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('kb.article_not_updated <li>'.$e->getMessage().'</li>')));
            return redirect()->back();
        }
    }

    /**
     * Delete an Agent by id.
     *
     * @param type         $id
     * @param type Article $article
     *
     * @return Response
     */
    public function destroy($slug, Article $article, Relationship $relation, Comment $comment)
    {
        /* delete the selected article from the table */
        $article = $article->where('slug', $slug)->first(); //get the selected article via id
        $id = $article->id;
        $comments = $comment->where('article_id', $id)->get();
        if ($comments) {
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }
        // deleting relationship
        $relation = $relation->where('article_id', $id)->first();
        if ($relation) {
            $relation->delete();
        }
        if ($article) {
            if ($article->delete()) {//true:redirect to index page with success message

                 Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('kb.article_deleted_successfully')));


                return redirect('admin/helpdesk/kb/article');
            } else { //redirect to index page with fails message
                Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('kb.article_cannot_be removed')));
                return redirect('admin/helpdesk/kb/article');
            }
        } else {
            Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('kb.cannot_delete_this_article')));
            return redirect('admin/helpdesk/kb/article');
        }
    }

    /**
     * user time zone
     * fetching timezone.
     *
     * @param type $utc
     *
     * @return type
     */
    public static function usertimezone($utc)
    {
        $user = Auth::user();
        $tz = $user->timezone;
        $set = Settings::whereId('1')->first();
        $format = $set->dateformat;
        //$utc = date('M d Y h:i:s A');
        date_default_timezone_set($tz);
        $offset = date('Z', strtotime($utc));
        $date = date($format, strtotime($utc) + $offset);
        echo $date;
    }
}
