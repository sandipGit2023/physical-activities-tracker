<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Leaderboard</h1>

        <form method="GET" action="{{ route('leaderboard') }}" class="mb-4">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <input type="text" name="search" class="form-control" placeholder="Search User ID" value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <select name="period" class="form-control">
                        <option value="day" {{ request('period') == 'day' ? 'selected' : '' }}>Today</option>
                        <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>This Month</option>
                        <option value="year" {{ request('period') == 'year' ? 'selected' : '' }}>This Year</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Rank</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Total Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaderboard as $ranking)
                        <tr>
                            <td>{{ $ranking->rank }}</td>
                            <td>{{ $ranking->user->id }}</td>
                            <td>{{ $ranking->user->name }}</td>
                            <td>{{ $ranking->total_points }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form method="POST" action="{{ route('leaderboard.recalculate') }}" class="text-center mt-4">
            @csrf
            <button type="submit" class="btn btn-warning">Re-calculate</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
