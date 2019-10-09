<?php

namespace Modules\ThemeChooser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\ThemeChooser\Entities\Theme;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class ThemeChooserController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Example controller';

    public function index(Content $content)
    {
        return $content
            ->title('Theme Chooser')
            ->description('View')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append("HAI");
                });

                $row->column(4, function (Column $column) {
                    $column->append("HAI2");
                });

                $row->column(4, function (Column $column) {
                    $column->append("HAI3");
                });
            });
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Theme);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('nama_tema');
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Theme::findOrFail($id));

        $show->field('id', __('ID'));
        $show->column('nama_tema');
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Theme);

        $form->display('id', __('ID'));
        $form->text('nama_tema', __('Nama Tema'))->rules('required');
        $form->text('author', __('Pembuat'))->rules('required');
        $form->file('path_style', __('File Style'))->downloadable();
        $form->image('picture', __('Gambar'))->rules('required');
        $form->textarea('description', __('Deskripsi'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }
}
