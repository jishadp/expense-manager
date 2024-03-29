<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('dashboard')}}" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('liabilities.list')}}" class="nav-link">Liabilities</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('incomes.list')}}?year={{ date('Y')}}&month={{date('m')}}" class="nav-link">Incomes</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('expenses.list')}}?year={{ date('Y')}}&month={{date('m')}}" class="nav-link">Expenses</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('pnl.view')}}?year={{ date('Y')}}&month={{date('m')}}" class="nav-link">P & L</a>
      </li>
    </ul>
  </nav>
