<ul>
    @php
        use App\Models\User;
        $children = User::where('upid', $user->id)->get();
    @endphp
    @foreach ($children as $child)
        <li>
            <a href="{{ url('sales-child/' . $child->id) }}">{{ $child->name }} <br> {{ $child->phone }} <br> Level {{ $child->level }} </a>
            @php
                $grandchildren = User::where('upid', $child->id)->get();
            @endphp

            @if ($grandchildren->count() > 0)
                <ul>
                    @foreach ($grandchildren as $grandchild)
                        <li>
                            <a href="{{ url('sales-child/' . $grandchild->id) }}">{{ $grandchild->name }} <br> {{ $grandchild->phone }} <br> Level {{ $grandchild->level }} </a>
                            @include('accounts.sales.genealogy.partials.tree', ['user' => $grandchild])
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
