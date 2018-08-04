<?php

namespace App\Http\Controllers;

use App\Address;
use App\Attendance;
use App\Category;
use App\Country;
use App\Item;
use App\Membership;
use App\MembershipType;
use App\Rules\LettersOnly;
use App\Rules\MembershipStartDateRule;
use App\Rules\StartDateRule;
use App\Subcategory;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use JavaScript;
use stdClass;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('adminHome');
    }

    public function items()
    {
        return view('items');
    }

    public function newItem()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $subcategoriesArray = array();

        //preparing all subcategories so they would be usable in javascript
        foreach ($subcategories as $subcategory) {
            $subcategoriesArray[] = array($subcategory->id, $subcategory->categoryID, $subcategory->name);
        }
        JavaScript::put([
            "subcategories" => $subcategoriesArray
        ]);

        return view('newItem', ['categories' => $categories]);
    }

    public function saveItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:25',
            'price' => 'required|numeric|gte:0',
            'manufacturer' => 'required|string|min:3|max:40',
            'size' => 'string',
            'description' => 'required|string',
            'category' => 'exists:categories,id',
            'subcategory' => 'exists:subcategories,id',
            'image' => 'required|image'
        ]);

        $item = new Item();
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->manufacturer = $request->input('manufacturer');
        $item->size = $request->input('size');
        $item->description = $request->input('description');
        $item->categoryID = $request->input('category');
        $item->subcategoryID = $request->input('subcategory');
        $item->save();
        $item->image = 'item' . $item->id . '.jpg';
        $image = $request->file('image');
        $image->move('../storage/app/public/itemImages', $item->image);
        $item->save();
        return redirect()->back();
    }

    public function addWorker()
    {
        $countries = Country::all();
        return view('addWorker', ['countries' => $countries]);
    }

    public function saveWorker(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'min:3', 'max:25', new LettersOnly()],
            'lastName' => ['required', 'string', 'min:3', 'max:25', new LettersOnly()],
            'birthDate' => 'required|date|before:today',
            'email' => 'required|email|unique:users',
            'address' => 'required|string|min:3|max:50',
            'city' => 'required|string|min:3|max:50',
            'zip' => 'numeric|required',
            'country' => 'required|exists:countries,id'
        ]);

        $user = new User();
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->birthDate = $request->input('birthDate');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->type = 'employee';
        $user->save();

        $address = new Address();
        $address->address = $request->input('address');
        $address->city = $request->input('city');
        $address->ZIPcode = $request->input('zip');
        $address->countryID = $request->input('country');
        $address->userID = $user->id;
        $address->save();
        return redirect()->back();
    }

    public function addMembershipType()
    {
        return view('addMembershipType');
    }

    public function saveMembershipType(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:memberships', 'min:3', 'max 20', new LettersOnly()],
            'price' => 'digit|numeric|gte:0'
        ]);

        $type = new MembershipType();
        $type->name = $request->input('name');
        $type->price = $request->input('price');
        $type->save();
        return redirect()->back();
    }

    public function addMember()
    {
        $types = MembershipType::all();
        return view('addMember', ['types' => $types]);
    }

    public function saveMember(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'min:3', 'max:30', new LettersOnly()],
            'lastName' => ['required', 'string', 'min:3', 'max:30', new LettersOnly()],
            'birthDate' => 'required|date|before:today',
            'email' => 'email|unique:users',
            'membershipCardNumber' => 'required|digits:8|unique:users',
            'startDate' => ['required', 'date', 'after_or_equal:today'],
            'endDate' => ['required', 'date', 'after:startDate']
        ]);

        $user = new User();
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->birthDate = $request->input('birthDate');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->membershipCardNumber = $request->input('membershipCardNumber');
        $user->type = 'member';
        $user->save();

        $membership = new Membership();
        $membership->startDate = $request->input('startDate');
        $membership->endDate = $request->input('endDate');
        $membership->typeID = $request->input('type');
        $membership->userID = $user->id;
        $membership->save();

        return redirect()->back();
    }

    public function allMembers()
    {
        $members = User::where('type', 'member')->get();
        $membersData = array();
        foreach ($members as $member) {
            //finding end date of last membership for every member and addig all the data to an array to send to view
            $membership = Membership::where('userID', $member->id)->orderBy('endDate', 'desc')->get();
            $membersData[] = array('id' => $member->id, 'firstName' => $member->firstName, 'lastName' => $member->lastName, 'email' => $member->email, 'endDate' => $membership[0]->endDate);
        }
        return view('members', ['membersData' => $membersData]);
    }

    public function showUpdateMemberForm($id)
    {
        $member = User::find($id);
        $memberships = Membership::where('userID', $member->id)->orderBy('endDate', 'desc')->get();
        $membershipType = MembershipType::find($memberships[0]->typeID);
        return view('updateMember', ['member' => $member, 'membership' => $memberships[0], 'type' => $membershipType]);
    }

    public function updateMember(Request $request, $id)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'min:3', 'max:30', new LettersOnly()],
            'lastName' => ['required', 'string', 'min:3', 'max:30', new LettersOnly()],
            'birthDate' => 'required|date|before:today',
            'email' => 'email|unique:users',
            'membershipCardNumber' => 'required|digits:8|unique:users',
        ]);
        $member = User::find($id);
        $member->firstName = $request->input('firstName');
        $member->lastName = $request->input('lastName');
        $member->birthDate = $request->input('birthDate');
        $member->membershipCardNumber = $request->input('membershipCardNumber');
        $member->email = $request->input('email');
        $member->save();
        return redirect('members');
    }

    public function deleteMember($id)
    {
        $member = User::find($id);
        $member->delete();
        return redirect('members');
    }

    public function addMembership($id)
    {
        $types = MembershipType::all();
        return view('addMembership', ['id' => $id, 'types' => $types]);
    }

    public function saveMembership($id, Request $request)
    {
        $request->validate([
            'startDate' => ['required', 'date', new MembershipStartDateRule($id)],
            'endDate' => 'required|date|after:startDate',
            'type' => 'exists:membership_types,id'
        ]);

        $membership = new Membership();
        $membership->userID = $id;
        $membership->typeID = $request->input('type');
        $membership->startDate = $request->input('startDate');
        $membership->endDate = $request->input('endDate');
        $membership->save();
        return redirect('members');
    }

    public function allItems()
    {
        $items = Item::all();
        $itemsData = array();
        foreach ($items as $item) {
            $category = Category::find($item->categoryID);
            $subcategory = Subcategory::find($item->subcategoryID);
            $itemsData[] = array('id' => $item->id, 'name' => $item->name, 'price' => $item->price, 'category' => $category->name, 'subcategory' => $subcategory->name, 'image' => $item->image);
        }
        return view('items', ['itemsData' => $itemsData]);
    }

    public function showUpdateItemForm($id)
    {
        $item = Item::find($id);
        $subcategoriesArray = array();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        foreach ($subcategories as $subcategory) {
            $subcategoriesArray[] = array($subcategory->id, $subcategory->categoryID, $subcategory->name);
        }
        $category = Category::find($item->categoryID);
        $subcategory = Subcategory::find($item->subcategoryID);
        JavaScript::put(['subcategories' => $subcategoriesArray, 'categoryID' => $category->id, 'subcategoryID' => $subcategory->id]);

        return view('editItem', ['item' => $item, 'categories' => $categories]);
    }

    public function updateItem(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:25',
            'price' => 'numeric|gte:0|required',
            'manufacturer' => 'required|string|min:3|max:30',
            'description' => 'required|string|min:3',
            'category' => 'required|exists:categories,id',
            'subcategory' => 'required|exists:subcategories:id',
            'image' => 'required|image'
        ]);

        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->manufacturer = $request->input('manufacturer');
        $item->description = $request->input('description');
        $item->categoryID = $request->input('category');
        $item->subcategoryID = $request->input('subcategory');
        //if another image is uploaded delete previous one and save new one under the same name
        if ($request->image) {
            Storage::delete('/public/storage/itemImages/' . $item->image);
            $image = $request->file('image');
            $image->move('../storage/app/public/itemImages', $item->image);
        }
        $item->save();
        return redirect('items');
    }

    public function deleteItem($id){
        $item = Item::find($id);
        $item->delete();
        return redirect('items');
    }

    public function showAttendance()
    {
        $attendances = Attendance::whereNull('exitTime')->get();
        $data = array();
        foreach ($attendances as $attendance) {
            $member = User::find($attendance->userID);
            $data[] = array('id' => $attendance->id, 'user' => $member->firstName . ' ' . $member->lastName, 'arrivalTime' => $attendance->arrivalTime);
        }
        return view('attendance', ['data' => $data]);
    }

    public function addAttendance(Request $request)
    {
        $request->validate([
            'cardNumber' => 'required|digits:8|exists:users,membershipCardNumber'
        ]);

        $time = new DateTime();
        $attendances = Attendance::whereNull('exitTime')->get();
        $member = User::where('membershipCardNumber', $request->input('cardNumber'))->get();
        foreach ($attendances as $attendance) {
            if ($attendance->userID == $member[0]->id) {
                $attendance->exitTime = $time->format('H:i:s');
                $attendance->save();
                return redirect('attendance');
            }
        }
        $attendance = new Attendance();
        $attendance->userID = $member[0]->id;
        $attendance->date = $time->format('Y-m-d');
        $attendance->arrivalTime = $time->format('H:i:s');
        $attendance->save();
        return redirect('attendance');
    }

    public function activeMemberships()
    {
        $time = new DateTime();
        $date = $time->format('Y-m-d');
        $memberships = Membership::where('endDate', '>', $date)->get();
        $active = array();
        foreach ($memberships as $membership) {
            $user = User::find($membership->userID);
            $type = MembershipType::find($membership->typeID);
            $active[] = array('user' => $user->firstName . ' ' . $user->lastName, 'type' => $type->name, 'startDate' => $membership->startDate, 'endDate' => $membership->endDate);
        }
        return view('activeMemberships', ['actives' => $active]);
    }

    public function membershipTypes()
    {
        $types = MembershipType::all();
        return view('membershipTypes', ['types' => $types]);
    }

    public function editMembershipType($id)
    {
        $type = MembershipType::find($id);
        return view('editMembershipType', ['type' => $type]);
    }

    public function saveEditMembershipType(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'unique:memberships', 'min:3', 'max 20', new LettersOnly()],
            'price' => 'digit|numeric|gte:0'
        ]);
        $type = MembershipType::find($id);
        $type->name = $request->name;
        $type->price = $request->price;
        $type->save();
        return redirect('membershipTypes');
    }

    public function allEmployees()
    {
        $employees = User::where('type', 'employee')->get();
        return view('employees', ['employees' => $employees]);
    }

    public function editEmployee($id)
    {
        $employee = User::find($id);
        return view('editEmployee', ['employee' => $employee]);
    }

    public function saveEditEmployee(Request $request, $id)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'min:3', 'max:25', new LettersOnly()],
            'lastName' => ['required', 'string', 'min:3', 'max:25', new LettersOnly()],
            'birthDate' => 'required|date|before:today',
            'email' => 'required|email|unique:users',
            'address' => 'required|string|min:3|max:50',
            'city' => 'required|string|min:3|max:50',
            'zip' => 'numeric|required',
            'country' => 'required|exists:countries,id'
        ]);

        $employee = User::find($id);
        $employee->firstName = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->birthDate = $request->birthDate;
        $employee->email = $request->email;
        $employee->save();
        return redirect('employees');
    }

    public function deleteEmployee($id){
        $employee = User::find($id);
        $employee->delete();
        return redirect('employees');
    }

    public function addCategory(){
        return view('addCategory');
    }

    public function allCategories()
    {
        $categories = Category::all();
        $categoriesData = array();
        foreach ($categories as $category) {
            $subcategories = Subcategory::where('categoryID', $category->id)->get();
            $subcategoriesData = ' ';
            foreach ($subcategories as $subcategory) {
                $subcategoriesData .= $subcategory->name . ', ';
            }
            $categoriesData[] = array('id' => $category->id, 'category' => $category->name, 'subcategories' => $subcategoriesData);
        }
        return view('categories', ['categories' => $categoriesData]);
    }

    public function saveCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|string'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return view('addSubcategory', ['id' => $category->id]);
    }

    public function addSubcategory($id)
    {
        return view('addSubcategory', ['id' => $id]);
    }

    public function saveSubcategory(Request $request, $id)
    {
        $request->validate([
            'name' => ['string', 'required', 'min:3', 'unique:subcategories'],
        ]);

        $subcategory = new Subcategory();
        $subcategory->categoryID = $id;
        $subcategory->name = $request->name;
        $subcategory->save();
        if ($request->check == 1) {
            return view('addSubcategory', ['id' => $id]);
        }
        return redirect('categories');
    }

}
