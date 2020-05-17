
<div class="table-responsive">
    <table id="referrals-table" class="table table-condensed">
        @if(count($referrals)>0)
        <thead class="">
            <tr class="bg-indigo-600">
                <th>
                    {{trans('users.username')}}
                </th>
                <th>
                    {{trans('users.email')}}
                </th>
                <th>
                    {{trans('users.name')}}
                </th>
                <th>
                    Package
                </th>
                <th>
                    {{trans('users.date_joined')}}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($referrals as $refs)

            <tr class="">
                <td>
                    {{$refs->username}}
                </td>
                <td>
                    {{$refs->email}}
                </td>
                <td>
                    {{$refs->name}} {{$refs->lastname}}
                </td>
                  <td>
                    {{$refs->packagename}} 
                </td>
                <td>
                    {{ date('d M Y',strtotime($refs->created_at)) }}
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
        <tr class="">
            <td>
                {{trans('users.no_data_found')}}
            </td>
        </tr>
        @endif
    </table>
</div>