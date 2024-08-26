<?php
        session_start();

        if (!isset($_SESSION['user_logged_in'])){
            header('Location: login');
            exit();
        }

        require '../components/header.php';
        require '../components/db.php';
        include '../components/navbar.php';

        $currentStep = isset($_GET['step']) ? (int)$_GET['step'] : 1;

        if ($currentStep < 1) $currentStep = 1;
        if ($currentStep > 5) $currentStep = 5;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clientID']) && !empty($_POST['clientID'])) {
            $clientID = $_POST['clientID'];
        
            // Fetch client details from the database
            $query = "SELECT * FROM application WHERE clientID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $clientID);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()){
                $appManager = $row['appManager'];
                $appManagerContactNumber = $row['appManagerContactNumber'];
                $appManagerTelephoneNumber = $row['appManagerTelephoneNumber'];
                $natureBusiness = $row['natureBusiness'];
                $psicNum = $row['psicNum'];
                $psicDesc = $row['psicDesc'];
                $appDateClient = $row['appDateClient'];
                $appNumEployees = $row['appNumEmployees'];
                $appPCOName = $row['appPCOName'];
                $appPCOMobileNumber = $row['appPCOMobileNumber'];
                $appPCOTelephoneNumber = $row['appPCOTelephoneNumber'];
                $appPCOEmail = $row['appPCOEmail'];
                $appPCOAccredNo = $row['appPCOAccredNo'];
                $appPCODateAccred = $row['appPCODateAccred'];
                $appFaciRegion = $row['appFaciRegion'];
                $appFaciProvince = $row['appFaciProvince'];
                $appFaciCity = $row['appFaciCity'];
                $appFaciBarangay = $row['appFaciBarangay'];
                $appFaciZip = $row['appFaciZip'];
                $appGeoLatitude = $row['appGeoLatitude'];
                $appGeoLongitude = $row['appGeoLongitude'];
                $appStatus = $row['appStatus'];
            }
        }
    ?>

<style>
    .custom-nav-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 1rem; 
        min-width: 120px; 
        height: 60px; 
    }
</style>
<div class="container w-75">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <ul class="navbar-nav mx-auto d-flex flex-wrap justify-content-center">
                <li class="nav-item text-center">
                    <?php if ($currentStep > 1): ?>
                        <a class="nav-link p-3 bg-success text-white custom-nav-btn" href="?step=<?php echo $currentStep - 1; ?>">
                            Previous<br>
                        </a>
                    <?php else: ?>
                        <span class="nav-link p-3 bg-secondary text-white disabled custom-nav-btn">
                            Previous<br>
                        </span>
                    <?php endif; ?>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link p-3 <?php echo $currentStep === 1 ? 'bg-white text-success border border-success' : 'bg-success text-white'; ?> disabled custom-nav-btn" href="#">
                        Step 1<br>Basic Information
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link p-3 <?php echo $currentStep === 2 ? 'bg-white text-success border border-success' : 'bg-success text-white'; ?> disabled custom-nav-btn" href="#">
                        Step 2<br>Select Waste
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link p-3 <?php echo $currentStep === 3 ? 'bg-white text-success border border-success' : 'bg-success text-white'; ?> disabled custom-nav-btn" href="#">
                        Step 3<br>Choose a Transporter
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link p-3 <?php echo $currentStep === 4 ? 'bg-white text-success border border-success' : 'bg-success text-white'; ?> disabled custom-nav-btn" href="#">
                        Step 4<br>Choose a TSD Facility
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link p-3 <?php echo $currentStep === 5 ? 'bg-white text-success border border-success' : 'bg-success text-white'; ?> disabled custom-nav-btn" href="#">
                        Step 5<br>Upload Required Documents
                    </a>
                </li>
                <li class="nav-item text-center">
                    <?php if ($currentStep < 5): ?>
                        <a class="nav-link p-3 bg-success text-white custom-nav-btn" href="?step=<?php echo $currentStep + 1; ?>">
                            Next<br>
                        </a>
                    <?php else: ?>
                        <span class="nav-link p-3 bg-secondary text-white disabled custom-nav-btn">
                            Next<br>
                        </span>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
</div>

<?php
// Example of how you might initialize these variables if they are not set
$appManager = isset($appManager) ? $appManager : "Default Manager";
$appManagerContactNumber = isset($appManagerContactNumber) ? $appManagerContactNumber : "#";
$appManagerTelephoneNumber = isset($appManagerTelephoneNumber) ? $appManagerTelephoneNumber : "#";
$natureBusiness = isset($natureBusiness) ? $natureBusiness : "Default Business";
$psicNum = isset($psicNum) ? $psicNum : "#";
$psicDesc = isset($psicDesc) ? $psicDesc : "Default Description";
$appDateClient = isset($appDateClient) ? $appDateClient : "";
$appNumEmployees = isset($appNumEmployees) ? $appNumEmployees : "0";
$appPCOName = isset($appPCOName) ? $appPCOName : "Default PCO Name";
$appPCOMobileNumber = isset($appPCOMobileNumber) ? $appPCOMobileNumber : "#";
$appPCOTelephoneNumber = isset($appPCOTelephoneNumber) ? $appPCOTelephoneNumber : "#";
$appPCOEmail = isset($appPCOEmail) ? $appPCOEmail : "default@example.com";
$appPCOAccredNo = isset($appPCOAccredNo) ? $appPCOAccredNo : "#";
$appPCODateAccred = isset($appPCODateAccred) ? $appPCODateAccred : "";
$appFaciProvince = isset($appFaciProvince) ? $appFaciProvince : "Default Province";
$appFaciBarangay = isset($appFaciBarangay) ? $appFaciBarangay : "Default Barangay";
$appFaciCity = isset($appFaciCity) ? $appFaciCity : "Default City/Municipality";
$appFaciZip = isset($appFaciZip) ? $appFaciZip : "Default Zip Code";
?>
<!-- <form action="functions.php" method="POST"> -->
    <?php if ($currentStep === 1): ?>
        <div class="container w-75">
            <div class="card my-3">
                <div class="card-body">
                    <h1 class="fw-bold my-3 me-2">General Information</h1>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <label for="clientName" class="form-label fw-bold">Company</label>
                            <form method="POST">
                                <select class="form-control" name="clientID" onchange="this.form.submit()">
                                    <option value="">Select option</option>
                                    <?php
                                        $clientQuery = "SELECT * FROM client WHERE isActive = 1 AND clientStatus = 'Approved'";
                                        $clientResult = mysqli_query($conn, $clientQuery);
                                        
                                        while($row = mysqli_fetch_assoc($clientResult)) {
                                            $clientID   = $row['clientID'];
                                            $clientName = $row['clientName'];

                                            echo "<option value=\"$clientID\">$clientName</option>";
                                        }
                                    ?>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="managingHead" class="form-label fw-bold">Managing Head</label>
                            <input class="form-control" type="text" name="managingHead" placeholder="Managing Head" value="<?php echo $appManager; ?>" disabled>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="managingHeadMobNum" class="form-label fw-bold">Mobile Number</label>
                            <input class="form-control" type="text" name="managingHeadMobNum" placeholder="Mobile Number" value="<?php echo $appManagerContactNumber; ?>"  disabled>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="managingHeadTelNum" class="form-label fw-bold">Telephone Number</label>
                            <input class="form-control" type="text" name="managingHeadTelNum" placeholder="Telephone Number" value="<?php echo $appManagerTelephoneNumber; ?>" disabled>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="natureBusiness" class="form-label fw-bold">Nature of Business</label>
                            <input class="form-control" type="text" name="natureBusiness" placeholder="Nature of Business" value="<?php echo $natureBusiness; ?>" disabled>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="psicNum" class="form-label fw-bold">PSIC Number</label>
                            <input class="form-control" type="text" name="psicNum" placeholder="PSIC Number" value="<?php echo $psicNum; ?>" disabled>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="psicDesc" class="form-label fw-bold">PSIC Description</label>
                            <input class="form-control" type="text" name="psicDesc" placeholder="PSIC Description" value="<?php echo $psicDesc; ?>"  disabled>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="natureBusiness" class="form-label fw-bold">Date of Establishment</label>
                            <input class="form-control" type="date" name="natureBusiness" placeholder="Nature of Business" value="<?php echo $appDateClient; ?>" disabled>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="appNumEmployees" class="form-label fw-bold">No. of Employees</label>
                            <input class="form-control" type="text" name="numEmployees" placeholder="No. Of Employees" value="<?php echo $appNumEmployees; ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body">
                    <h1 class="fw-bold my-3 me-2">Pollution Control Officer Information</h1>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <label for="clientName" class="form-label fw-bold">PCO Name</label>
                            <input class="form-control" type="text" name="pcoName" placeholder="Name of Pollution Control Officer" value="<?php echo $appPCOName; ?>"disabled>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <label for="managingHead" class="form-label fw-bold">PCO Mobile Number</label>
                            <input class="form-control" type="text" name="pcoMobNum" placeholder="Mobile Number of Pollution Control Officer" value="<?php echo $appPCOMobileNumber; ?>"disabled>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <label for="managingHeadMobNum" class="form-label fw-bold">PCO Telephone Number</label>
                            <input class="form-control" type="text" name="pcoTelNum" placeholder="Telephone Number of Pollution Control Officer"value="<?php echo $appPCOTelephoneNumber; ?>" disabled>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <label for="managingHeadTelNum" class="form-label fw-bold">PCO E-mail Address</label>
                            <input class="form-control" type="email" name="pcoEmail" placeholder="E-mail Address of Pollution Control Officer" value="<?php echo $appPCOEmail; ?>"disabled>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="natureBusiness" class="form-label fw-bold">PCO Accreditation No.</label>
                            <input class="form-control" type="text" name="pcoAccredNo" placeholder="Accreditation No. of Pollution Control Officer" value="<?php echo $appPCOAccredNo; ?>"disabled>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="psicNum" class="form-label fw-bold">PCO Date of Accreditation</label>
                            <input class="form-control" type="date" name="pcoAccredDate" placeholder="Date of Accreditation of Pollution Control Officer" value="<?php echo $appPCODateAccred; ?>"disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body">
                    <h1 class="fw-bold my-3 me-2">Facility Address</h1>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="region" class="form-label fw-bold">Region</label>
                            <select class="form-control" id="region" name="region" disabled>
                                <option value="">Select Region</option>
                                <?php
                                    $regionQuery = "SELECT * FROM refregion";
                                    $regionResult = mysqli_query($conn, $regionQuery);
                                    while($row = mysqli_fetch_assoc($regionResult)) {
                                        echo "<option value=\"".$row['regCode']."\">".$row['regDesc']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="province" class="form-label fw-bold">Province</label>
                            <input class="form-control" type="text" name="province" placeholder="Select Province" value="<?php echo $appFaciProvince; ?>"disabled>
                        </div>
                    </div>
                    
                    <div class="row align-items-center my-2">
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <label for="city" class="form-label fw-bold">City/Municipality</label>
                        <input class="form-control" type="text" name="city" placeholder="Select City/Municipality" value="<?php echo htmlspecialchars($appFaciCity, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <label for="barangay" class="form-label fw-bold">Barangay</label>
                        <input class="form-control" type="text" name="barangay" placeholder="Select Barangay" value="<?php echo htmlspecialchars($appFaciBarangay, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <label for="zipCode" class="form-label fw-bold">Zip Code</label>
                        <input class="form-control" type="text" name="zipCode" placeholder="Zip Code" value="<?php echo htmlspecialchars($appFaciZip, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                    </div>
                </div>
            <div class="card my-3">
                <div class="card-body">
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <h1 class="fw-bold my-3 me-2">Geolocation</h1>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="latitude" class="form-label fw-bold">Latitude</label>
                            <input class="form-control" type="text" name="latitude" placeholder="Latitude coordinates" disabled>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <label for="longitude" class="form-label fw-bold">Longitude</label>
                            <input class="form-control" type="text" name="longitude" placeholder="Longitude coordinates" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card my-3">
    <div class="card-body">
        <div class="row align-items-center my-2">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <h2 class="fw-bold my-3 me-2">Environmental Compliance Permits</h2>
            </div>
        </div>
        <div class="row align-items-center my-2">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <table class="table table-responsive table-hover">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Application #</th>
                            <th scope="col">Company</th>
                            <th scope="col">Reference Code</th>
                            <th scope="col">Approved Date</th>
                            <th scope="col">Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card my-3">
    <div class="card-body">
        <div class="row align-items-center my-2">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <h2 class="fw-bold my-3 me-2">Product and Service Information</h2>
            </div>
        </div>
        <div class="row align-items-center my-2">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <table class="table table-responsive table-hover">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Application #</th>
                            <th scope="col">Product</th>
                            <th scope="col">Service</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>                 

<div class="card my-3">
    <div class="card-body">
        <div class="row align-items-center my-2">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <h2 class="fw-bold my-3 me-2">Hazardous Waste Profile</h2>
            </div>
        </div>
        <div class="row align-items-center my-2">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <table class="table table-responsive table-hover">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Nature</th>
                            <th scope="col">Catalogue</th>
                            <th scope="col">Details</th>
                            <th scope="col">Current Waste Management Practice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                            <td class="text-center">Hello</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>     
    <?php elseif ($currentStep === 2): ?>
        <div class="container w-75 my-5">
            <div class="card my-3">
                <div class="card-body">
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <h1 class="fw-bold my-3 me-2">Waste Information</h1>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 text-end">
                        <button type="button" class="btn text-white" style="background-color:#253E23"  href="#" data-bs-toggle="modal" data-bs-target="#addWasteModal" role="button">
                                <i class="fa-solid fa-plus me-1"></i>Add Waste
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <table class="table table-responsive table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Waste Code</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Quantity in metric tonnes(MT)</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">
                                            <div class="text-center me-1">
                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#viewClientModal<?php echo $clientID; ?>">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($currentStep === 3): ?>
        <div class="container w-75 my-5">
            <div class="card my-3">
                <div class="card-body">
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <h1 class="fw-bold my-3 me-2">Generator Information</h1>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 text-end">
                        <button class="btn text-white" style="background-color:#253E23" data-bs-toggle="modal" data-bs-target="#addClientModal" role="button">
                        <i class="fa-solid fa-plus me-1"></i>Add More
                        </button>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <table class="table table-responsive table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Order/Sequence</th>
                                        <th scope="col">Transporter ID</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Expiry Date</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">Hello</td>
                                        <td class="text-center">
                                            <div class="text-center me-1">
                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#viewClientModal<?php echo $clientID; ?>">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php elseif ($currentStep === 4): ?>
    <div class="container w-75">
        <div class="card my-3">
            <div class="card-body">
                <h1 class="fw-bold my-3 me-2">TSD Facility</h1>
                <div class="row align-items-center my-2">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <label for="clientName" class="form-label fw-bold">TSD Facility</label>
                        <select class="form-control">
                            <option value="">Select option</option>
                            <option value="EGC Enterprise">EGC Enterprise</option>
                            <option value="Maya Med Waste Corporation">Maya Med Waste Corporation</option>
                            <option value="All Waste Service Inc">All Waste Service Inc</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php elseif ($currentStep === 5): ?>
        <div class="container w-75 my-5">
            <div class="card my-3">
                <div class="card-body">
                    <div class="row align-items-center my-2">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <h1 class="fw-bold my-3 me-2">Upload Attachments</h1>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                Notarized Memorandum of Agreement/Affidavit of Undertaking/Service Agreement between HW Generator, TSD Facility and HW Transporter *
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                Result of Laboratory Analysis
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Transport Management Plan *
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                Schedule of Hauling/Transport of wastes *
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                Route of Transport *
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                Last 2 previous Self Monitoring Report *
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <button class="btn text-white w-100" style="background-color:#586854"  href="#" data-bs-toggle="modal" data-bs-target="#addClientModal" role="button">
                                <i class="fa-solid fa-plus me-1"></i>Add Files
                            </button>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <button class="btn text-white w-100" style="background-color:#253E23"  href="#" data-bs-toggle="modal" data-bs-target="#addClientModal" role="button">
                                <i class="fa-solid fa-check-to-slot"></i>Finalize Application
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</form>

<div class="modal fade" id="addWasteModal" tabindex="-1" aria-labelledby="addWasteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWasteModalLabel">Add Waste Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="functions.php" method="post" enctype="multipart/form-data">
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="wasteType" class="form-label">Waste:</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <select class="form-control" name="wasteType">
                                <option value="">Please select a waste</option>
                                <option value="A101">A101 - Wastes with Cyanide</option>
                                <option value="B201">B201 - Sulfuric Acid</option>
                                <option value="B202">B202 - Hydrochloric Acid</option>
                                <option value="B203">B203 - Nitric Acid</option>
                                <option value="B204">B204 - Phosphoric Acid</option>
                                <option value="B205">B205 - Hydrofluoric Acid</option>
                                <option value="B206">B206 - Mixture of Sulfuric and Hydrochloric Acid</option>
                                <option value="B207">B207 - Other Inorganic Acid</option>
                                <option value="B208">B208 - Organic Acid</option>
                                <option value="B299">B299 - Other Acid Waste</option>
                                <option value="C301">C301 - Caustic Soda</option>
                                <option value="C302">C302 - Potash</option>
                                <option value="C303">C303 - Alkaline Cleaners</option>
                                <option value="C304">C304 - Ammonium Hydroxide</option>
                                <option value="C305">C305 - Lime Slurries</option>
                                <option value="C399">C399 - Other Alkali Wastes</option>
                                <option value="D401">D401 - Selenium and its Compounds</option>
                                <option value="D403">D403 - Barium and its Compounds</option>
                                <option value="D404">D404 - Cadmium and its Compounds</option>
                                <option value="D405">D405 - Chromium Compounds</option>
                                <option value="D406">D406 - Lead Compounds</option>
                                <option value="D407">D407 - Mercury and Mercury Compounds</option>
                                <option value="D408">D408 - Fluoride and its Compounds</option>
                                <option value="D499">D499 - Other Wastes with Inorganic Chemicals</option>
                                <option value="E501">E501 - Oxidizing Agents</option>
                                <option value="E502">E502 - Reducing Agents</option>
                                <option value="E503">E503 - Explosive and Unstable Chemicals</option>
                                <option value="E599">E599 - Highly Reactive Chemicals</option>
                                <option value="F601">F601 - Solvent Based</option>
                                <option value="F602">F602 - Inorganic Pigments</option>
                                <option value="F603">F603 - Ink Formulation</option>
                                <option value="F604">F604 - Resinous Materials</option>
                                <option value="F699">F699 - Other Mixed</option>
                                <option value="G703">G703 - Halogenated Organic Solvent</option>
                                <option value="G704">G704 - Non-Halogenated Organic Solvents</option>
                                <option value="H802">H802 - Grease Wastes</option>
                                <option value="I101">I101 - Used Industrial Oil Including Sludge</option>
                                <option value="I102">I102 - Vegetable Oil Including Sludge</option>
                                <option value="I103">I103 - Tallow</option>
                                <option value="I104">I104 - Oil-Contaminated Materials</option>
                                <option value="J201">J201 - Containers Previously Containing Toxic Chemical Substances</option>
                                <option value="K301">K301 - Solidified Wastes</option>
                                <option value="K302">K302 - Chemically Fixed and Polymerized Wastes</option>
                                <option value="K303">K303 - Encapsulated Wastes</option>
                                <option value="L401">L401 - Wastes with Specific Halogenated Toxic Organic Chemicals</option>
                                <option value="L402">L402 - Wastes with Specific Non-Halogenated Toxic Organic Chemicals</option>
                                <option value="M501">M501 - Pathological or Infectious Wastes</option>
                                <option value="M503">M503 - Pharmaceuticals and Drugs</option>
                                <option value="M504">M504 - Pesticides</option>
                                <option value="M505">M505 - Persistent Organic Pollutants (POPs) Waste</option>
                                <option value="M506">M506 - Waste Electrical and Electronic Equipment (WEEE)</option>
                                <option value="M507">M507 - Special Wastes</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center my-2">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <label for="wasteNature" class="form-label">Amount in metric tonnes(MT)</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <input class="form-control" type="text" name="metrictonnes" placeholder="Metric Tonnes" required>
                        </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" name="addWaste" class="btn btn-success w-25">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>