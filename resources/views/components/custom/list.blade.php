@include('components.custom.search')
@props(['models', 'columns'])
<div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
    <table class="w-full text-sm text-left rtl:text-right text-white">
        <thead class="bg-gray-600 border-b border-default">
          <tr>
            @foreach ($columns as $title => $column)
            <th scope="col" class="px-6 py-3 font-medium">
              {{$title}}
            </th>
            @endforeach
          </tr>
        </thead>
        <tbody>
        @if ($models->isEmpty())
          <tr>
            <td colspan="{{ count($columns) }}" class="px-6 py-4 text-center text-black">
              No data found
            </td>
          </tr>
          @else
          @foreach ($models as $model)
            <tr class="odd:bg-gray-400 even:bg-gray-500 border-b border-default">
            @foreach ($columns as $column)
              <td class="px-6 py-4">
                {{ $model->{$column} }}
              </td>
            @endforeach
            </tr>
          @endforeach        
        @endif
      </tbody>
    </table>
</div>