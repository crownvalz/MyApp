@if(request()->is('stockreplenish*'))
<table id="AiTable" class="min-w-full border border-gray-200 divide-y rounded-lg shadow-sm">
    <thead class="bg-gradient-to-r from-blue-400 via-white to-gray-200 text-gray-800">
        @php
            $headers = [
                'Actions', 'Item Name', 'Supplier', 'Unit Price', 'Restocked Qty',
                'Requested By', 'Request Date', 'Approved By', 'Status', 'Action'
            ];
            $sortableIndices = [1, 2, 3, 4, 5, 6, 7, 8]; // All except 'Actions' columns
        @endphp
        <tr>
            @foreach($headers as $index => $title)
                <th class="text-sm p-3 text-left {{ in_array($index, [5]) ? 'hidden sm:table-cell' : '' }}"
                    @if(in_array($index, $sortableIndices)) onclick="sortTable({{ $index - 1 }})" @endif>
                    {{ $title }}
                    @if(in_array($index, $sortableIndices))
                        <i class="fa fa-sort"></i>
                    @endif
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody id="tableBody" class="text-gray-700 divide-y">
        @forelse($stockTable as $report)
        <tr class="hover:bg-blue-100 transition" data-status="{{ $report->status }}">
            <td class="p-3">
                <button data-report='@json($report)' class="open-edit-modal text-green-700">
                    <i class="fa fa-edit"></i>
                </button>
            </td>
            <td class="p-3">{{ $report->item_name }}</td>
            <td class="p-3">{{ $report->supplier }}</td>
            <td class="p-3">Tsh {{ number_format($report->unit_price, 2) }}</td>
            <td class="p-3">{{ $report->restocked_quantity }}</td>
            <td class="p-3 hidden sm:table-cell">{{ strtok($report->requested_by, ' ') }}</td>
            <td class="p-3">{{ \Carbon\Carbon::parse($report->created_at)->format('d M Y') }}</td>
            <td class="p-3">{{ strtok($report->approved_by, ' ') }}</td>
            <td class="p-3">{{ $report->status }}</td>
            <td class="p-3">
                <div class="flex space-x-2 text-xs">
                    @foreach([
                        ['route' => 'stock.approve', 'icon' => 'check', 'label' => 'Approve', 'color' => 'green', 'method' => 'PUT'],
                        ['route' => 'stock.reject',  'icon' => 'times', 'label' => 'Reject',  'color' => 'red',   'method' => 'PUT'],
                        ['route' => 'stock.destroy', 'icon' => 'trash', 'label' => 'Delete',  'color' => 'red',   'method' => 'DELETE'],
                    ] as $action)
                        <form action="{{ route($action['route'], $report->id) }}" method="POST">
                            @csrf @method($action['method'])
                            <button type="submit" class="text-{{ $action['color'] }}-600 hover:text-{{ $action['color'] }}-800 transition">
                                <i class="fa fa-{{ $action['icon'] }}"></i>
                                <span class="hidden sm:inline">{{ $action['label'] }}</span>
                            </button>
                        </form>
                    @endforeach
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center p-4 text-gray-500">No data. Go read Bible instead..</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif


@if(request()->is('stockreport*'))
<table id="AiTable" class="min-w-full border border-gray-200 divide-y rounded-lg shadow-sm">
    <thead class="bg-gradient-to-r from-blue-400 via-white to-gray-200 text-gray-800">
        @php
            $headers = [
                'Item Name', 'Description', 'Stock Before', 'Requested Qty',
                'Balance', 'Requested By', 'Applied Date', 'Approved By', 'Approved Date'
            ];
            $sortableIndices = [1, 2, 3, 4, 5, 6, 7, 8, 9]; // all except first column
        @endphp
        <tr>
            @foreach($headers as $index => $title)
                <th class="text-sm p-3 text-left {{ in_array($index, [3, 6, 7, 8]) ? 'hidden sm:table-cell' : '' }}" 
                    @if(in_array($index, $sortableIndices)) onclick="sortTable({{ $index - 1 }})" @endif>
                    @if($title === '')
                        <i class="fa fa-times text-green-700 rounded-lg"></i>
                    @else
                        {{ $title }} <i class="fa fa-sort"></i>
                    @endif
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody id="tableBody" class="text-gray-700 divide-y">
        @forelse ($StockReport as $report)
            <tr class="hover:bg-blue-50 hover:shadow transition-all duration-200" data-status="{{ $report->status }}">
                <td class="p-3">{{ $report->item_name }}</td>
                <td class="p-3 {{ $report->description == 'Withdrawal - Sabasaba Branch' ? 'text-red-600' : 'text-blue-600' }}">{{ $report->description }}</td>
                <td class="p-3 hidden sm:table-cell">{{ $report->stock_before }}</td>
                <td class="p-3">{{ $report->requested_quantity }}</td>
                <td class="p-3">{{ $report->balance }}</td>
                <td class="p-3 hidden sm:table-cell">{{ strtok($report->requested_by, ' ') }}</td>
                <td class="p-3 hidden sm:table-cell">{{ \Carbon\Carbon::parse($report->applied_date)->format('d M Y') }}</td>
                <td class="p-3 hidden sm:table-cell">{{ substr(strrchr($report->approved_by, ' '), 1) }}</td>
                <td class="p-3">{{ \Carbon\Carbon::parse($report->approved_date)->format('d M Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center p-4 text-gray-500">No data. Go read Bible instead..</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endif

@if(request()->is('staff*'))
<table id="AiTable" class="min-w-full border border-gray-200 divide-y rounded-lg shadow-sm">
    <thead class="bg-gradient-to-r from-blue-400 via-white to-gray-200 text-gray-800">
        @php
            $headers = ['Name', 'Email', 'Position', 'Salary', 'Leave Balance', 'Status', 'Actions'];
            $sortableIndices = [1, 2, 3, 4, 5, 6]; // Exclude Edit and Actions columns
        @endphp
        <tr>
            @foreach($headers as $index => $title)
                <th class="text-sm p-3 text-left {{ in_array($index, [4, 5]) ? 'hidden sm:table-cell' : '' }}"
                    @if(in_array($index, $sortableIndices)) onclick="sortTable({{ $index - 1 }})" @endif>
                    {{ $title }}
                    @if(in_array($index, $sortableIndices))
                        <i class="fa fa-sort"></i>
                    @endif
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody id="tableBody" class="text-gray-700 divide-y">
        @forelse($allstaff as $staff)
        <tr data-status="{{ $staff->status }}" class="hover:bg-blue-50 transition">
            <td class="p-3">{{ $staff->name }}</td>
            <td class="p-3">{{ $staff->email }}</td>
            <td class="p-3">{{ $staff->position }}</td>
            <td class="p-3 hidden sm:table-cell">{{ $staff->salary }}</td>
            <td class="p-3 hidden sm:table-cell">{{ $staff->leave_bal }}</td>
            <td class="p-3">
                <span class="px-2 py-1 rounded-full text-xs shadow-sm
                    {{ $staff->status == 'Approved' ? 'bg-green-100 text-green-700' : 
                        ($staff->status == 'Rejected' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700') }}">
                    {{ $staff->status }}
                </span>
            </td>
            <td class="p-3">
                <div class="flex space-x-2 text-xs">
                    @foreach([
                        ['route' => 'staff.approve', 'icon' => 'check', 'label' => 'Approve', 'color' => 'green', 'method' => 'PUT'],
                        ['route' => 'staff.destroy', 'icon' => 'trash', 'label' => 'Delete', 'color' => 'red', 'method' => 'DELETE'],
                        ['route' => 'staff.block',   'icon' => 'ban',   'label' => 'Block',   'color' => 'red', 'method' => 'PUT'],
                        ['route' => 'staff.reset',   'icon' => 'sync',  'label' => 'Reset',   'color' => 'red', 'method' => 'PUT'],
                    ] as $action)
                        <form action="{{ route($action['route'], $staff->id) }}" method="POST">
                            @csrf @method($action['method'])
                            <button data-report='@json($staff)' type="submit" data-report='{{ $action['color'] }}' class="text-{{ $action['color'] }}-600 hover:text-{{ $action['color'] }}-800 transition">
                                <i class="fa fa-{{ $action['icon'] }}"></i>
                                <span class="hidden sm:inline">{{ $action['label'] }}</span>
                            </button>
                        </form>
                    @endforeach
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center p-4 text-gray-500">No data. Go read Bible instead..</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif


@if(request()->is('leave*'))
<table id="AiTable" class="min-w-full border border-gray-200 divide-y rounded-lg shadow-sm">
    <thead class="bg-gradient-to-r from-blue-400 via-white to-gray-200 text-gray-800">
        @php
            $headers = ['Employee', 'Leave Type', 'Start', 'End', 'Days', 'Status', 'Actions'];
            $sortableIndices = [0, 1, 2, 3, 4, 5, 6];
        @endphp
        <tr>
            @foreach($headers as $index => $title)
                <th class="text-sm p-3 text-left {{ in_array($title, ['Start', 'End', 'Days']) ? 'hidden sm:table-cell' : '' }}"
                    @if(in_array($index, $sortableIndices)) onclick="sortTable({{ $index }})" @endif>
                    {{ $title }}
                    @if(in_array($index, $sortableIndices))
                        <i class="fa fa-sort"></i>
                    @endif
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody id="tableBody" class="text-gray-700 divide-y">
        @forelse ($leaveTable as $leave)
        <tr data-status="{{ $leave->status }}" class="hover:bg-blue-50 hover:shadow transition-all duration-200 ease-in-out">
            <td class="p-3">{{ $leave->name }}</td>
            <td class="p-3">{{ $leave->leave_type }}</td>
            <td class="p-3 hidden sm:table-cell">{{ $leave->start_date }}</td>
            <td class="p-3 hidden sm:table-cell">{{ $leave->end_date }}</td>
            <td class="p-3 hidden sm:table-cell">
                {{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}
            </td>
            <td class="p-3">
                <span class="px-2 py-1 rounded-full text-xs shadow-sm
                    {{ $leave->status == 'Approved' ? 'bg-green-100 text-green-700' : 
                        ($leave->status == 'Rejected' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700') }}">
                    {{ $leave->status }}
                </span>
            </td>
            <td class="text-sm p-3">
                <div class="flex space-x-2 text-xs">
                    @foreach([
                        ['type' => 'form', 'route' => 'leave.approve', 'icon' => 'check-circle', 'label' => 'Approve', 'color' => 'green', 'method' => 'PUT'],
                        ['type' => 'form', 'route' => 'leave.reject', 'icon' => 'times-circle', 'label' => 'Reject', 'color' => 'red', 'method' => 'PUT'],
                        ['type' => 'button', 'icon' => 'edit', 'label' => 'Edit', 'color' => 'blue', 'action' => "openEditModal({$leave->id}, '{$leave->leave_type}', '{$leave->start_date}', '{$leave->end_date}', '{$leave->status}')"],
                        ['type' => 'form', 'route' => 'leave.destroy', 'icon' => 'trash', 'label' => 'Delete', 'color' => 'red', 'method' => 'DELETE'],
                    ] as $action)
                        @if($action['type'] === 'form')
                            <form action="{{ route($action['route'], $leave->id) }}" method="POST">
                                @csrf @method($action['method'])
                                <button type="submit" class="text-{{ $action['color'] }}-600 hover:text-{{ $action['color'] }}-800 transition">
                                    <i class="fa fa-{{ $action['icon'] }}"></i>
                                    <span class="hidden sm:inline">{{ $action['label'] }}</span>
                                </button>
                            </form>
                        @else
                            <button onclick="{{ $action['action'] }}"
                                class="text-{{ $action['color'] }}-600 hover:text-{{ $action['color'] }}-800 transition">
                                <i class="fa fa-{{ $action['icon'] }}"></i>
                                <span class="hidden sm:inline">{{ $action['label'] }}</span>
                            </button>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center p-4 text-gray-500">No data. Go read Bible instead..</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif


@if(request()->is('stationery*'))
<table id="AiTable" class="min-w-full border border-gray-200 divide-y rounded-lg shadow-sm">
    <thead class="bg-gradient-to-r from-blue-400 via-white to-gray-200 text-gray-800">
        @php
            $headers = ['Item Name', 'Quantity', 'Request Date', 'Requested By', 'Approved By', 'Status', 'Actions'];
            $sortableIndices = [0, 1, 2, 3, 4, 5, 6]; // Only sortable columns
        @endphp
        <tr>
            @foreach($headers as $index => $title)
                <th class="text-sm p-3 text-left {{ in_array($index, [3,4,5]) ? 'hidden sm:table-cell' : '' }}"
                    @if(in_array($index, $sortableIndices)) onclick="sortTable({{ $index }})" @endif>
                    {{ $title }}
                    @if(in_array($index, $sortableIndices))
                        <i class="fa fa-sort"></i>
                    @endif
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody id="tableBody" class="text-gray-700 divide-y">
        @forelse ($requestsTable as $request)
        <tr class="hover:bg-blue-50 hover:shadow transition duration-150 ease-in-out" data-status="{{ $request->status }}">
            <td class="p-3">{{ $request->item_name }}</td>
            <td class="p-3">{{ $request->quantity }}</td>
            <td class="p-3 hidden sm:table-cell">{{ $request->request_date }}</td>
            <td class="p-3 hidden sm:table-cell">{{ explode(' ', $request->requested_by)[0] }}</td>
            <td class="p-3 hidden sm:table-cell">{{ explode(' ', $request->approved_by)[0] }}</td>
            <td class="p-3">
                <span class="px-2 py-1 rounded-full text-xs shadow-sm
                    {{ $request->status == 'Approved' ? 'bg-green-100 text-green-700' : 
                       ($request->status == 'Rejected' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700') }}">
                    {{ $request->status }}
                </span>
            </td>
            <td class="p-3">
                <div class="flex space-x-3 text-xs">
                    @foreach([
                        ['route' => 'requests.approve', 'icon' => 'check-circle', 'label' => 'Approve', 'color' => 'green', 'method' => 'PUT'],
                        ['route' => 'requests.reject',  'icon' => 'times-circle', 'label' => 'Reject',  'color' => 'red',   'method' => 'PUT'],
                        ['route' => 'requests.destroy', 'icon' => 'trash',        'label' => 'Delete',  'color' => 'red',   'method' => 'DELETE'],
                    ] as $action)
                        <form action="{{ route($action['route'], $request->id) }}" method="POST">
                            @csrf @method($action['method'])
                            <button type="submit" class="text-{{ $action['color'] }}-600 hover:text-{{ $action['color'] }}-800 transition">
                                <i class="fa fa-{{ $action['icon'] }}"></i>
                                <span class="hidden sm:inline">{{ $action['label'] }}</span>
                            </button>
                        </form>
                    @endforeach
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center p-4 text-gray-500">No data. Go read Bible instead..</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif


@if(request()->is('sadaka*'))
<table id="AiTable" class="min-w-full border border-gray-200 divide-y rounded-lg shadow-sm">
    <thead class="bg-gradient-to-r from-blue-400 via-white to-gray-200 text-gray-800">
        @php
            $headers = ['Category', 'Amount', 'Note', 'Date'];
            $sortableIndices = [0, 1, 2, 3]; // All columns are sortable
        @endphp
        <tr>
            @foreach($headers as $index => $title)
                <th class="text-sm p-3 text-left"
                    @if(in_array($index, $sortableIndices)) onclick="sortTable({{ $index }})" @endif>
                    {{ $title }}
                    @if(in_array($index, $sortableIndices))
                        <i class="fa fa-sort"></i>
                    @endif
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody id="tableBody" class="text-gray-700 divide-y">
        @forelse ($sadakas as $sadaka)
        @php
            $columns = [
            'category' => $sadaka->category,
            'amount' => $sadaka->amount,
            'note' => $sadaka->note,
            'created_at' => $sadaka->created_at->format('d M Y'),
            ];
        @endphp
        <tr class="hover:bg-blue-50 hover:shadow transition duration-150 ease-in-out">
            @foreach($columns as $value)
            <td class="p-3">{{ $value }}</td>
            @endforeach
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center p-4 text-gray-500">No data. Go read Bible instead..</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif
