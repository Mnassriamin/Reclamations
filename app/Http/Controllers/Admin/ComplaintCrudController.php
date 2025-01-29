<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ComplaintCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ComplaintCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Complaint::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/complaint');
        CRUD::setEntityNameStrings('complaint', 'complaints');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $user = backpack_user();

        if ($user->user_type === 1) { // Admin
            // Admins see all complaints, including treated ones
            CRUD::column('user_id')->type('select')->entity('user')->attribute('name')->label('Customer');
            CRUD::column('technician_id')->type('select')->entity('technician')->attribute('name')->label('Treated by');
            CRUD::column('subject');
            CRUD::column('description');
            CRUD::column('status')->type('select_from_array')->options([
                'pending' => 'Pending',
                'treated' => 'Treated',
                'cancelled' => 'Cancelled',
            ]);
            CRUD::column('updated_at')->label('Treated At')->type('datetime');
        } 
        elseif ($user->user_type === 2) { // Technician
            // Show only pending complaints to technicians
            CRUD::addClause('where', 'status', 'pending');

            CRUD::column('user_id')->type('select')->entity('user')->attribute('name')->label('Customer');
            CRUD::column('subject');
            CRUD::column('description');
            CRUD::column('status')->type('select_from_array')->options([
                'pending' => 'Pending',
                'treated' => 'Treated',
                'cancelled' => 'Cancelled',
            ]);
        }
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,treated,cancelled',
        ]);

        CRUD::field('user_id')->type('select')->entity('user')->attribute('name')->label('Customer');
        CRUD::field('subject');
        CRUD::field('description');
        CRUD::field('status')->type('select_from_array')->options([
            'pending' => 'Pending',
            'treated' => 'Treated',
            'cancelled' => 'Cancelled',
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $user = backpack_user();

        if ($user->user_type === 2) { // Technician
            CRUD::field('status')->type('select_from_array')->options([
                'treated' => 'Treated',
                'cancelled' => 'Cancelled',
            ])->validationRules('required');

            \App\Models\Complaint::updating(function ($entry) use ($user) {
                if ($entry->status === 'treated') {
                    $entry->technician_id = $user->id;
                }
            });
        }

        if ($user->user_type === 1) { // Admin
            CRUD::field('technician_id')->type('select')->entity('technician')->attribute('name')->label('Treated by');
            CRUD::field('status')->type('select_from_array')->options([
                'pending' => 'Pending',
                'treated' => 'Treated',
                'cancelled' => 'Cancelled',
            ]);
        }
    }
}
