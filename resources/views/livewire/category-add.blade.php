<div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2 px-2 my-2"
                style="display: @if ($is_shown == true) none @else block @endif">
                <button wire:click="show_inputs" type="button" class="form-control btn btn-outline-success">Add</button>
            </div>

            <div class="card-body d-flex"
                style="display: @if ($is_shown == true) flex @else none @endif !important">
                <div class="col-md-3">
                    <input wire:model="name_uz" type="text" class="form-control" placeholder="Name Uz" />
                </div>
                <div class="col-md-3 px-2">
                    <input wire:model="name_ru" type="text" class="form-control" id="defaultFormControlInput"
                        placeholder="Name Ru" aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="col-md-3">
                    <input wire:model="name_en" type="text" class="form-control" id="defaultFormControlInput"
                        placeholder="Name En" aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="col-md-2 px-2">
                    <button wire:click="add" type="button" class="form-control btn btn-outline-{{$button_color}}">{{$button}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>Name Uz</th>
                    <th>Name Ru</th>
                    <th>Name En</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">
                            {{ $loop->index + 1 + ($categories->currentPage() - 1) * $categories->perPage() }}</th>
                        <td>{{ $category->name_uz }}</td>
                        <td>{{ $category->name_ru }}</td>
                        <td>{{ $category->name_en }}</td>
                        <td>
                            <button wire:click="delete({{ $category }})" class="form-control btn btn-outline-danger" style="width: 90px">Delete</button>
                            <button wire:click="edit({{ $category }})" class="form-control btn btn-outline-warning" style="width: 90px">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $categories->links() }}
        </table>
    </div>
</div>
