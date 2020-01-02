<?php namespace App\Http\Controllers\Admin\Helpdesk\kb;

// Controllers

use App\Http\Controllers\Admin\AdminController;

// Requests
use App\Http\Requests\Admin\Helpdesk\kb\CategoryRequest;
use App\Http\Requests\Admin\Helpdesk\kb\CategoryUpdate;
// Model
use App\Models\Helpdesk\kb\Category;
use App\Models\Helpdesk\kb\Relationship;
// Classes
use Datatables;
use Exception;
use Lang;
use Redirect;
use Session;

/**
 * CategoryController
 * This controller is used to CRUD category.
 *
 * @author      Ladybird <info@ladybirdweb.com>
 */
class CategoryController extends AdminController
{
    

    /**
     * Indexing all Category.
     *
     * @param type Category $category
     *
     * @return Response
     */
    public function index()
    {
        /*  get the view of index of the catogorys with all attributes
          of category model */
        $category  = new Category();
        $category  = Category::pluck('name', 'id')->toArray();
        $title     = trans('kb.categories');
        $sub_title = trans('kb.categories');
        $base      = trans('kb.categories');
        $method    = trans('kb.categories');

        try {
            return view('app.admin.helpdesk.kb.category.index',compact('title','sub_title','base','method','category'));
        } catch (Exception $e) {
            return redirect()->back()->with('fails', $e->getMessage());
        }
    }

    /**
     * fetching category list in chumper datatables.
     *
     * @return type chumper datatable
     */
    public function data()
    {
        /* fetching chumper datatables */
        $category  = new Category();
        $category = $category->select('id', 'name','slug','description','created_at')->get();
        // dd($tickets);
        return Datatables::of($category)

                        /* search column name */
                        // ->searchColumns('name')
                        /* order column name and description */
                        // ->orderColumns('name', 'description')
                        /* add column name */
                        ->remove_column('id')
                        ->editColumn('name', function ($model) {
                            $string = strip_tags($model->name);

                           

                            return '<span class="table-element-editable category" data-type="text" data-url=' . url("admin/helpdesk/tickets/departments/update") . ' data-pk="' . $model->id . '" data-title="Enter category name" data-name="name">' . str_limit($string, 20) . '</span>';
                            
                        })
                        ->editColumn('slug', function ($model) {
                            $string = strip_tags($model->slug);
                           

                            return '<span class="table-element-editable category" data-type="text" data-url=' . url("admin/helpdesk/tickets/departments/update") . ' data-pk="' . $model->id . '" data-title="Enter category slug" data-name="slug">' . str_limit($string, 20) . '</span>';

                        })
                        ->editColumn('description', function ($model) {
                            $string = strip_tags($model->description);
                           

                            return '<span class="table-element-editable category" data-type="wysihtml5" data-url=' . url("admin/helpdesk/tickets/departments/update") . ' data-pk="' . $model->id . '" data-title="Enter category description" data-name="description" data-value="'.$model->description.'">' . str_limit($string, 20) . '</span>';

                        })
                        /* add column Created */
                        ->editColumn('Created', function ($model) {
                            $t = $model->created_at;

                            return $t;
                        })
                        /* add column Actions */
                        /* there are action buttons and modal popup to delete a data column */
                        ->addColumn('action', function ($model) {
                    return ' <a class="btn btn-xs btn-success" href="'.url('admin/helpdesk/kb/category/'.$model->id.'/edit/').'/">Edit</a>
                                    &nbsp;
                                    <button class="btn btn-warning btn-info btn-xs btn-delete-kb-category" data-id="'.$model->id.'"> delete </button>';
                })
                        ->escapeColumns([])
                        ->make();
    }

    /**
     * Create a Category.
     *
     * @param type Category $category
     *
     * @return type view
     */
    // public function create(Category $category)
    // {
        
    //     $category = $category->lists('name', 'id')->toArray();
        
    //     try {
    //         return view('themes.default1.agent.kb.category.create', compact('category'));
    //     } catch (Exception $e) {
    //         return redirect()->back()->with('fails', $e->getMessage());
    //     }
    // }

    /**
     * To store the selected category.
     *
     * @param type Category        $category
     * @param type CategoryRequest $request
     *
     * @return type Redirect
     */
    public function store(Category $category, CategoryRequest $request)
    {
        /* Get the whole request from the form and insert into table via model */
        $sl = $request->input('name');
        $slug = str_slug($sl, '-');
        $category->slug = $slug;
     
        
        // send success message to index page
        try {

            $category->fill($request->input())->save();
            

            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('kb.category_inserted')));

            return Redirect::back();

        } catch (Exception $e) {

              Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('kb.category_not_inserted')));
              return Redirect::back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param type          $slug
     * @param type Category $category
     *
     * @return type view
     */
    public function edit($id)
    {
        /* get the atributes of the category model whose id == $id */
        $category = Category::whereId($id)->first();
        $categories = Category::pluck('name', 'id')->toArray();
        $title     = trans('kb.categories');
        $sub_title = trans('kb.categories');
        $base      = trans('kb.categories');
        $method    = trans('kb.categories');
        
        try {
            return view('app.admin.helpdesk.kb.category.edit',compact('title','sub_title','base','method','category','categories'));
        } catch (Exception $e) {
            return redirect()->back()->with('fails', $e->getMessage());
        }

    }

    /**
     * Update the specified Category in storage.
     *
     * @param type                $slug
     * @param type Category       $category
     * @param type CategoryUpdate $request
     *
     * @return type redirect
     */
    public function update($id, CategoryRequest $request)
    {

        /* Edit the selected category via id */
        $category = Category::where('id', $id)->first();
        $sl = $request->input('name');
        $slug = str_slug($sl, '-');
        /* update the values at the table via model according with the request */
        //redirct to index page with success message
        try {
            $category->slug = $slug;
            $category->fill($request->input())->save();

              Session::flash('flash_notification', array('level' => 'success', 'message' => trans('kb.category_updated_successfully')));

              return redirect('admin/helpdesk/kb/category');

            


        } catch (Exception $e) {
            //redirect to index with fails message
            return redirect()->back()->with('fails', trans('kb.category_not_updated').'<li>'.$e->getMessage().'</li>');
        }
    }

    /**
     * Remove the specified category from storage.
     * @param type              $id
     * @param type Category     $category
     * @param type Relationship $relation
     *
     * @return type Redirect
     */
    public function destroy($id, Category $category, Relationship $relation)
    {
        $relation = $relation->where('category_id', $id)->first();
        if ($relation != null) {
            Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('kb.category_not_deleted')));

            return Redirect::back();
        } else {
            /*  delete the category selected, id == $id */
            $category = $category->whereId($id)->first();
            // redirect to index with success message
            try {
                $category->delete();
                Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('kb.category_deleted_successfully')));

                return Redirect::back();
            } catch (Exception $e) {
                 Session::flash('flash_notification', array('level' => 'warning', 'message' => trans('kb.category_not_deleted<br/><div class"aa">'.$e->getMessage().'</div>')));
                return Redirect::back();
            }
        }
    }
}
