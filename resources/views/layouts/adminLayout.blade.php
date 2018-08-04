<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/adminLayoutCSS.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css"
          integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"
            integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
            crossorigin="anonymous"></script>
</head>

<body>
<div class="nav-side-menu">
    <div class="brand"><img src="{{asset('images/zoo.jpg')}}" style="height: 100px; width: 100px;"></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <div class="menu-list">
        <ul id="menu-content" class="menu-content collapse out">

            <li>
                <a href="#">
                    <i class="fa fa-dashboard fa-lg"></i> Home
                </a>
            </li>

            <li data-toggle="collapse" data-target="#members" class="collapsed">
                <a href="#"><i class="fa fa-user fa-lg"></i> Members</a>
            </li>
            <ul class="sub-menu collapse" id="members">
                <li><a href="{{route('members')}}">
                        <div>All members</div>
                    </a></li>
                <li><a href="{{route('addMember')}}">
                        <div>New member</div>
                    </a></li>
            </ul>

            <li data-toggle="collapse" data-target="#memberships" class="collapsed">
                <a href="#"><i class="fa fa-calendar-alt fa-lg"></i> Memberships</a>
            </li>
            <ul class="sub-menu collapse" id="memberships">
                <li><a href="{{route('activeMemberships')}}">
                        <div>Active memberships</div>
                    </a></li>
                <li><a href="{{route('membershipTypes')}}">
                        <div>Membership types</div>
                    </a></li>
                <li><a href="{{route('addMembershipType')}}">
                        <div>New membership type</div>
                    </a></li>
            </ul>
            @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
                <li data-toggle="collapse" data-target="#employees" class="collapsed">
                    <a href="#"><i class="fa fa-user-tie fa-lg"></i> Employees</a>
                </li>
                <ul class="sub-menu collapse" id="employees">
                    <li><a href="{{route('employees')}}">
                            <div>All employees</div>
                        </a></li>
                    <li><a href="{{route('addWorker')}}">
                            <div>New employee</div>
                        </a></li>
                </ul>
            @endif
            <li data-toggle="collapse" data-target="#shopitems" class="collapsed">
                <a href="#"><i class="fa fa-shopping-cart fa-lg"></i> Shop items</a>
            </li>
            <ul class="sub-menu collapse" id="shopitems">
                <li><a href="{{route('items')}}">
                        <div>All items</div>
                    </a></li>
                <li><a href="{{route('newItem')}}">
                        <div>New item</div>
                    </a></li>
                <li><a href="{{route('categories')}}">
                        <div>Categories</div>
                    </a></li>
                <li><a href="{{route('addCategory')}}">
                        <div>New category</div>
                    </a></li>
            </ul>

            <li>
                <a href="{{route('attendance')}}">
                    <div>
                        <i class="fa fa-users fa-lg"></i>
                        Attendance
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="container" id="main">
    <div>
        <div>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</div>


</body>
</html>