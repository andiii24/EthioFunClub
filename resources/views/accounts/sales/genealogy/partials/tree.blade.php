{{-- <a href="#">{{ $user->name }}</a> --}}
<ul>
    @php
        use App\Models\User;
        $children = User::where('upid', $user->id)->get();
    @endphp

    @foreach ($children as $child)
        <li>
            <a href="{{ url('child/' . $child->id) }}">{{ $child->name }}</a>
            @php
                $grandchildren = User::where('upid', $child->id)->get();
            @endphp

            @if ($grandchildren->count() > 0)
                <ul>
                    @foreach ($grandchildren as $grandchild)
                        <li>
                            <a href="{{ url('child/' . $grandchild->id) }}">{{ $grandchild->name }}</a>
                            @include('accounts.sales.genealogy.partials.tree', ['user' => $grandchild])
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
