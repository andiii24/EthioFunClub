<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Level</th>
            <!-- Add more table columns as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->level }}</td>
                <!-- Add more table cells as needed -->
            </tr>
        @endforeach
    </tbody>
</table>
