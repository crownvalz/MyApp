{{-- Replenish Stock Modal --}}
@if(request()->is('stockreplenish*'))
<!-- Add Product Modal -->
<div id="Modal2" class="modal hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl relative overflow-hidden border border-gray-100">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50">
      <h2 class="text-xl font-semibold text-gray-800">Add New Stock</h2>
      <button type="button" class="close-modal text-gray-400 hover:text-gray-600 text-2xl font-bold transition">&times;</button>
    </div>
    <form action="{{ route('stock.store') }}" method="POST" class="p-6 space-y-5 text-gray-700">
      @csrf
      <input type="hidden" name="requested_by" value="{{ Auth::user()->name }}">
      <div>
        <label for="item_name" class="block font-medium mb-1">Item Name</label>
        <select id="item_name" name="item_name" class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" required>
            <option value="" disabled selected>Select an item</option>
            <option value="Pen">Pen</option>
            <option value="Pencil">Pencil</option>
            <option value="Notebook">Notebook</option>
            <option value="Envelope">Envelope</option>
            <option value="Glue Stick">Glue Stick</option>
            <option value="Marker">Marker</option>
            <option value="Eraser">Eraser</option>
            <option value="Highlighter">Highlighter</option>
            <option value="Stapler">Stapler</option>
            <option value="Paper Clips">Paper Clips</option>
            <option value="Scissors">Scissors</option>
            <option value="File Folder">File Folder</option>
            <option value="Sticky Notes">Sticky Notes</option>
            <option value="Whiteboard Marker">Whiteboard Marker</option>
            <option value="Correction Fluid">Correction Fluid</option>
            <option value="Binder Clips">Binder Clips</option>
            <option value="Printer Paper">Printer Paper</option>
            <option value="Document Wallet">Document Wallet</option>
            <option value="Calculator">Calculator</option>
            <option value="Desk Organizer">Desk Organizer</option>
          </select>
      </div>
      <div>
        <label for="supplier" class="block font-medium mb-1">Supplier</label>
        <select id="supplier" name="supplier" class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" required>
          <option value="" disabled selected>Select a supplier</option>
          <option value="BrightStar Supplies">BrightStar Supplies</option>
        </select>
      </div>
      <div>
        <label for="unit_price" class="block font-medium mb-1">Unit Price</label>
        <input type="number" id="unit_price" name="unit_price" step="0.01" class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" placeholder="Enter unit price" required>
      </div>
      <div>
        <label for="restocked_quantity" class="block font-medium mb-1">Stock Quantity</label>
        <input type="number" id="restocked_quantity" name="restocked_quantity" class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" placeholder="Enter quantity" required>
      </div>
      <div class="flex justify-end space-x-3 pt-4">
        <button type="button" class="close-modal px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Stock Modal -->
<div id="editModal" class="fixed inset-0 bg-black/40 flex justify-center items-center hidden z-50 backdrop-blur-sm">
  <div class="bg-white p-6 rounded-2xl w-full max-w-xl shadow-xl">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-semibold text-gray-800">Edit Stock Report</h3>
      <button type="button" id="cancelBtn" class="text-2xl text-gray-400 hover:text-gray-600 font-bold">&times;</button>
    </div>
    <form id="editForm" method="POST" action="@foreach($stockTable as $report){{ route('stockreport.update', $report->id) }}@endforeach">
      @csrf @method('PUT')
      <div id="dynamicFields"></div>
      <div class="flex justify-end space-x-3 pt-4">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
        <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
      </div>
    </form>
  </div>
</div>
@endif


{{-- Leave Request Modals --}}
@if(request()->is('leave*'))
<!-- Apply Leave Modal -->
<div id="Modal1" class="modal hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl relative overflow-hidden border border-gray-100">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50">
      <h2 class="text-xl font-semibold text-gray-800">New Leave Request</h2>
      <button type="button" class="close-modal text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
    </div>
    <form action="{{ route('leaves.store') }}" method="POST" class="p-6 space-y-5 text-gray-700">
      @csrf
      <div class="text-center text-blue-600 font-semibold">Leave Days: <span id="total-days">0</span></div>

      <input type="hidden" name="name" value="{{ Auth::user()->name }}">

      <select name="leave_type" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
        <option value="">Select Leave Type</option>
        <option value="Annual Leave">Annual Leave</option>
        <option value="Emergency Leave">Emergency Leave</option>
        <option value="Maternity Leave">Maternity Leave</option>
        <option value="Sick Leave">Sick Leave</option>
      </select>
      <input type="date" name="start_date" id="start_date" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
      <input type="date" name="end_date" id="end_date" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
      <textarea name="reason" rows="3" placeholder="Reason for Leave" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required></textarea>
      <div class="flex justify-end space-x-3 pt-4">
        <button type="button" class="close-modal px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Apply</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Leave Modal -->
<div id="editLeaveModal" class="modal hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
  <div class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold text-gray-800">Edit Leave Request</h2>
      <button onclick="closeEditModal()" class="text-2xl font-bold text-gray-400 hover:text-gray-600">&times;</button>
    </div>
    <form id="editLeaveForm" method="POST">
      @csrf @method('PUT')
      <input type="hidden" name="leave_id" id="leave_id">
      <div class="space-y-4">
        <input type="text" name="leave_type" id="leave_type" placeholder="Leave Type" class="w-full p-3 border rounded-md" required>
        <input type="date" name="start_date" id="start_date" class="w-full p-3 border rounded-md" required>
        <input type="date" name="end_date" id="end_date" class="w-full p-3 border rounded-md" required>
        <select name="status" id="status" class="w-full p-3 border rounded-md" required>
          <option value="Approved">Approved</option>
          <option value="Pending">Pending</option>
          <option value="Rejected">Rejected</option>
        </select>
      </div>
      <div class="flex justify-end space-x-3 pt-4">
        <button type="button" onclick="closeEditModal()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
      </div>
    </form>
  </div>
</div>
@endif


{{-- Modal for Requests Page --}}
@if(request()->is('stationery*'))
<!-- Modal -->
<div id="Modal2" class="modal hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm transition-all duration-300">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl relative overflow-hidden border border-gray-100">

    <!-- Modal Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50">
      <h2 class="text-xl font-semibold text-gray-800">Create New Product</h2>
      <button class="close-modal text-gray-400 hover:text-gray-600 text-2xl font-bold transition">&times;</button>
    </div>

    <!-- Modal Body -->
    <form class="p-6 space-y-5 text-gray-700" action="{{ route('requests.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <select id="item_name" name="item_name" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                <option value="" disabled selected>Select an item</option>
                @if(is_null($stockTable) || $stockTable->isEmpty())
                    <option value="Pen">Pen</option>
                    <option value="Stapler">Stapler</option>
                    <option value="Notebook">Notebook</option>
                @else
                    @foreach($stockTable->unique('item_name') as $item)
                        @if($item->status !== 'Out of Stock')
                            <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                        @endif
                    @endforeach
                @endif
            </select>

            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" id="quantity" name="quantity" class="mt-1 p-2 w-full border border-gray-300 rounded" required>

            <!-- Hidden input to store the applicant's name -->
            <input type="hidden" name="requested_by" value="{{ Auth::user()->name }}">
        </div>
      <div class="flex justify-end gap-3 pt-4">
        <button type="button" class="close-modal px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">Cancel</button>
        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition font-medium">Save</button>
      </div>
    </form>
  </div>
</div>
@endif





{{-- Modal for Requests Page --}}
@if(request()->is('staff*'))
<!-- Modal -->
<div id="Modal6" class="modal hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm transition-all duration-300">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl relative overflow-hidden border border-gray-100">

    <!-- Modal Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50">
      <h2 class="text-xl font-semibold text-gray-800">Add User</h2>
      <button class="close-modal text-gray-400 hover:text-gray-600 text-2xl font-bold transition">&times;</button>
    </div>

    <!-- Modal Body -->
    <form action="{{ route('staff.store') }}" method="POST" class="p-6 space-y-5 text-gray-700">
            @csrf
            <input type="text" name="name" placeholder="Full Name" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            <input type="email" name="email" placeholder="Email Address" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            
            <select name="position" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
                <option value="">Select Position</option>
                <option value="Manager">Manager</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Clerk">Clerk</option>
                <option value="Intern">Intern</option>
            </select>
            
            <input type="number" name="salary" placeholder="Salary" class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400" required>
            
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </form>
  </div>
</div>
@endif