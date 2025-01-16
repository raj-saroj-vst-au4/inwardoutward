<?php
// Start the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJMSOM Office Portal - Inward/Outward Software</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
    <style>
        .progress {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <!-- Top bar with logo and button -->
            <div class="col-12 d-flex justify-content-between align-items-center">
                <!-- Logo on the left -->
                <img src="assets/logos/SOM-IITB.png" alt="Logo" style="max-height: 50px;">
                <!-- Button on the right -->
                <a href="logout.php" class="btn btn-primary">Logout</a>
            </div>
        </div>
        <h1 class="text-center mb-4">SJMSOM Inward/Outward Portal</h1>
        <div class="row">
            <!-- Incoming Documents Form -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2 class="h4 mb-0">Incoming Documents</h2>
                    </div>
                    <div class="card-body">
                        <form class="documentForm" data-form-type="incoming" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Person Name</label>
                                <input type="text" class="form-control docType" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Received From</label>
                                <select class="form-select senderOrRecipient" required>
                                    <option value="">Select Department</option>
                                    <option value="Aerospace Engineering">Aerospace Engineering</option>
                                    <option value="Application Software Centre (ASC)">Application Software Centre (ASC)</option>
                                    <option value="Associate Dean Academic Programme (Associate Dean AP)">Associate Dean Academic Programme (Associate Dean AP)</option>
                                    <option value="Biomedical Engineering and Technology Incubation Centre (BETiC)">Biomedical Engineering and Technology Incubation Centre (BETiC)</option>
                                    <option value="Biosciences and Bioengineering">Biosciences and Bioengineering</option>
                                    <option value="Central Library">Central Library</option>
                                    <option value="Centre for Distance Engineering and Education Programme (CDEEP)">Centre for Distance Engineering and Education Programme (CDEEP)</option>
                                    <option value="Centre for Liberal Education (CLE)">Centre for Liberal Education (CLE)</option>
                                    <option value="Centre for Machine Intelligence and Data Science (C-MinDS)">Centre for Machine Intelligence and Data Science (C-MinDS)</option>
                                    <option value="Centre for Research in Nanotechnology and Science (CRNTS)">Centre for Research in Nanotechnology and Science (CRNTS)</option>
                                    <option value="Centre for Policy Studies (AD-CPS)">Centre for Policy Studies (AD-CPS)</option>
                                    <option value="Centre for Semiconductor Technologies (SemiX)">Centre for Semiconductor Technologies (SemiX)</option>
                                    <option value="Centre for Systems and Control">Centre for Systems and Control</option>
                                    <option value="Centre for Technology Alternatives for Rural Areas (CTARA)">Centre for Technology Alternatives for Rural Areas (CTARA)</option>
                                    <option value="Centre of Excellence in Oil, Gas and Energy (CoE-OGE)">Centre of Excellence in Oil, Gas and Energy (CoE-OGE)</option>
                                    <option value="Centre of Excellence in Quantum Information, Computing, Science and Technology (CoE-QuICST)">Centre of Excellence in Quantum Information, Computing, Science and Technology (CoE-QuICST)</option>
                                    <option value="Centre of Excellence in Steel Technology (CoEST)">Centre of Excellence in Steel Technology (CoEST)</option>
                                    <option value="Centre of Excellence on Membrane Technologies for Desalination, Brine Management, and Water Recycling">Centre of Excellence on Membrane Technologies for Desalination, Brine Management, and Water Recycling</option>
                                    <option value="Centre of Studies in Resources Engineering (CSRE)">Centre of Studies in Resources Engineering (CSRE)</option>
                                    <option value="Chemical Engineering">Chemical Engineering</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Civil Engineering">Civil Engineering</option>
                                    <option value="Climate Studies">Climate Studies</option>
                                    <option value="Computer Centre (CC)">Computer Centre (CC)</option>
                                    <option value="Computer Science & Engineering">Computer Science & Engineering</option>
                                    <option value="Dean Academic Programme (Dean AP)">Dean Academic Programme (Dean AP)</option>
                                    <option value="Dean Alumni Corporate Relations (Dean ACR)">Dean Alumni Corporate Relations (Dean ACR)</option>
                                    <option value="Dean Educational Outreach (Dean EO)">Dean Educational Outreach (Dean EO)</option>
                                    <option value="Dean Faculty">Dean Faculty</option>
                                    <option value="Dean Finance & Infra (Dean FIA)">Dean Finance & Infra (Dean FIA)</option>
                                    <option value="Dean Infrastructure Planning Support (Dean IPS)">Dean Infrastructure Planning Support (Dean IPS)</option>
                                    <option value="Dean International Relation (Dean IR)">Dean International Relation (Dean IR)</option>
                                    <option value="Dean RnD (IRCC)">Dean RnD (IRCC)</option>
                                    <option value="Dean Strategy">Dean Strategy</option>
                                    <option value="Dean Student Affairs (Dean SA)">Dean Student Affairs (Dean SA)</option>
				                    <option value="Deputy Director ART (DD ART)">Deputy Director ART (DD ART)</option>
				                    <option value="Deputy Director (DD FEA)">Deputy Director (DD FEA)</option>
                                    <option value="Deputy Registrar Academic (DR Acad)">Deputy Registrar Academic (DR Acad)</option>
                                    <option value="Deputy Registrar Admin (DR Admin)">Deputy Registrar Admin (DR Admin)</option>
                                    <option value="Deputy Registrar Finance & Accounts (DR F&A)">Deputy Registrar Finance & Accounts (DR F&A)</option>
                                    <option value="Deputy Registrar Material Management Division (DR MMD)">Deputy Registrar Material Management Division (DR MMD)</option>
                                    <option value="Desai Sethi School of Entrepreneurship (DSSE)">Desai Sethi School of Entrepreneurship (DSSE)</option>
				                    <option value="Directors Office">Directors Office</option>
                                    <option value="DRDO-Industry-Academia Centre of Excellence (DIA-CoE)">DRDO-Industry-Academia Centre of Excellence (DIA-CoE)</option>
                                    <option value="Earth Sciences">Earth Sciences</option>
                                    <option value="Economics">Economics</option>
                                    <option value="Educational Technology">Educational Technology</option>
                                    <option value="Electrical Engineering">Electrical Engineering</option>
                                    <option value="Electrical Maintenance Division (EMD)">Electrical Maintenance Division (EMD)</option>
                                    <option value="Energy Science and Engineering">Energy Science and Engineering</option>
                                    <option value="Environmental Science and Engineering (ESED)">Environmental Science and Engineering (ESED)</option>
                                    <option value="Estate Office">Estate Office</option>
                                    <option value="Gate Office">Gate Office</option>
                                    <option value="General Admin">General Admin</option>
                                    <option value="Geospatial Information Science and Engineering">Geospatial Information Science and Engineering</option>
                                    <option value="GMP (Good Manufacturing Practice) Lab">GMP (Good Manufacturing Practice) Lab</option>
                                    <option value="Green Energy and Sustainability Hub">Green Energy and Sustainability Hub</option>
                                    <option value="HDFC-Ergo IIT Bombay (HE-IITB) Innovation Lab">HDFC-Ergo IIT Bombay (HE-IITB) Innovation Lab</option>
                                    <option value="Hostel Coordinating Unit (HCU)">Hostel Coordinating Unit (HCU)</option>
                                    <option value="Humanities and Social Science (HSS)">Humanities and Social Science (HSS)</option>
                                    <option value="IDC School of Design (IDC SoD)">IDC School of Design (IDC SoD)</option>
                                    <option value="IIT Bombay Development and Relations Foundation (IITB-DRF)">IIT Bombay Development and Relations Foundation (IITB-DRF)</option>
                                    <option value="IIT Bombay FedEx Centre for Advanced Logistics and Analytics">IIT Bombay FedEx Centre for Advanced Logistics and Analytics</option>
                                    <option value="IITB Trust Lab">IITB Trust Lab</option>
                                    <option value="IITB-Monash Research Academy (Section 8 Company)">IITB-Monash Research Academy (Section 8 Company)</option>
                                    <option value="IITB-Research Park Foundation (IITB-RPF)">IITB-Research Park Foundation (IITB-RPF)</option>
                                    <option value="Industrial Engineering and Operations Research (IEOR)">Industrial Engineering and Operations Research (IEOR)</option>
                                    <option value="Institute of Eminence (IOE)">Institute of Eminence (IOE)</option>
                                    <option value="Jalvihar Guest House">Jalvihar Guest House</option>
                                    <option value="JEE Office">JEE Office</option>
                                    <option value="Koita Centre for Digital Health (KCDH)">Koita Centre for Digital Health (KCDH)</option>
                                    <option value="Legal Cell">Legal Cell</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                                    <option value="Metallurgical Engineering & Materials Science (MEMS)">Metallurgical Engineering & Materials Science (MEMS)</option>
                                    <option value="National Centre for Mathematics (NCM)">National Centre for Mathematics (NCM)</option>
                                    <option value="National Centre for Photovoltaic Research and Education (NCPRE)">National Centre for Photovoltaic Research and Education (NCPRE)</option>
                                    <option value="National Centre of Excellence in Carbon Capture and Utilization (NCoE-CCU)">National Centre of Excellence in Carbon Capture and Utilization (NCoE-CCU)</option>
                                    <option value="National Centre of Excellence in Technology for Internal Security (NCETIS)">National Centre of Excellence in Technology for Internal Security (NCETIS)</option>
                                    <option value="Padmavihar Guest House">Padmavihar Guest House</option>
                                    <option value="Parimal and Pramod Chaudhari Centre for Learning and Teaching (PPCCLT)">Parimal and Pramod Chaudhari Centre for Learning and Teaching (PPCCLT)</option>
                                    <option value="Photovoltaics Technology and Innovation Centre (PoTIC)">Photovoltaics Technology and Innovation Centre (PoTIC)</option>
                                    <option value="Physics">Physics</option>
                                    <option value="SBI Foundation Hub for Data Science and Analytics">SBI Foundation Hub for Data Science and Analytics</option>
                                    <option value="Security Office">Security Office</option>
                                    <option value="Society for Innovation and Entrepreneurship (SINE)">Society for Innovation and Entrepreneurship (SINE)</option>
                                    <option value="Sophisticated Analytical Instrument Facility (SAIF)">Sophisticated Analytical Instrument Facility (SAIF)</option>
                                    <option value="Sunita Sanghi Centre of Ageing and Neurodegenerative Diseases (SCAN)">Sunita Sanghi Centre of Ageing and Neurodegenerative Diseases (SCAN)</option>
                                    <option value="Tata Centre for Technology and Design (TCTD)">Tata Centre for Technology and Design (TCTD)</option>
                                    <option value="Technocraft Centre for Applied Artificial Intelligence (TCAAI)">Technocraft Centre for Applied Artificial Intelligence (TCAAI)</option>
                                    <option value="Technology Innovation Hub Foundation for IoT and IoE (TIH-IoT)">Technology Innovation Hub Foundation for IoT and IoE (TIH-IoT)</option>
                                    <option value="Vanvihar Guest House">Vanvihar Guest House</option>
                                    <option value="Wadhwani Research Centre for Bioengineering (WRCB)">Wadhwani Research Centre for Bioengineering (WRCB)</option>
                                    <option value="Water Innovation Centre: Technology, Research and Education (WICTRE)">Water Innovation Centre: Technology, Research and Education (WICTRE)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Receive Date</label>
                                <input type="date" class="form-control sendOrReceiveDate" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Description</label>
                                <textarea class="form-control description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload PDF Document</label>
                                <input type="file" class="form-control attachment" name="attachment" accept=".pdf" required>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>
                            <div class="alert alert-success" role="alert" style="display: none;">
                                Document uploaded successfully!
                            </div>
                            <div class="alert alert-danger" role="alert" style="display: none;">
                                Error uploading document. Please try again.
                            </div>
                            <button type="submit" class="btn btn-success">Submit Incoming Document</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Outgoing Documents Form -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h2 class="h4 mb-0">Outgoing Documents</h2>
                    </div>
                    <div class="card-body">
                        <form class="documentForm" data-form-type="outgoing" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Person Name</label>
                                <input type="text" class="form-control docType" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Send To</label>
                                <select class="form-select senderOrRecipient" required>
                                    <option value="">Select Department</option>
                                    <option value="Aerospace Engineering">Aerospace Engineering</option>
                                    <option value="Application Software Centre (ASC)">Application Software Centre (ASC)</option>
                                    <option value="Associate Dean Academic Programme (Associate Dean AP)">Associate Dean Academic Programme (Associate Dean AP)</option>
                                    <option value="Biomedical Engineering and Technology Incubation Centre (BETiC)">Biomedical Engineering and Technology Incubation Centre (BETiC)</option>
                                    <option value="Biosciences and Bioengineering">Biosciences and Bioengineering</option>
                                    <option value="Cash Section">Cash Section</option>
                                    <option value="Central Library">Central Library</option>
                                    <option value="Centre for Distance Engineering and Education Programme (CDEEP)">Centre for Distance Engineering and Education Programme (CDEEP)</option>
                                    <option value="Centre for Liberal Education (CLE)">Centre for Liberal Education (CLE)</option>
                                    <option value="Centre for Machine Intelligence and Data Science (C-MinDS)">Centre for Machine Intelligence and Data Science (C-MinDS)</option>
                                    <option value="Centre for Policy Studies (AD-CPS)">Centre for Policy Studies (AD-CPS)</option>
                                    <option value="Centre for Research in Nanotechnology and Science (CRNTS)">Centre for Research in Nanotechnology and Science (CRNTS)</option>
                                    <option value="Centre for Semiconductor Technologies (SemiX)">Centre for Semiconductor Technologies (SemiX)</option>
                                    <option value="Centre for Systems and Control">Centre for Systems and Control</option>
                                    <option value="Centre for Technology Alternatives for Rural Areas (CTARA)">Centre for Technology Alternatives for Rural Areas (CTARA)</option>
                                    <option value="Centre of Excellence in Oil, Gas and Energy (CoE-OGE)">Centre of Excellence in Oil, Gas and Energy (CoE-OGE)</option>
                                    <option value="Centre of Excellence in Quantum Information, Computing, Science and Technology (CoE-QuICST)">Centre of Excellence in Quantum Information, Computing, Science and Technology (CoE-QuICST)</option>
                                    <option value="Centre of Excellence in Steel Technology (CoEST)">Centre of Excellence in Steel Technology (CoEST)</option>
                                    <option value="Centre of Excellence on Membrane Technologies for Desalination, Brine Management, and Water Recycling">Centre of Excellence on Membrane Technologies for Desalination, Brine Management, and Water Recycling</option>
                                    <option value="Centre of Studies in Resources Engineering (CSRE)">Centre of Studies in Resources Engineering (CSRE)</option>
                                    <option value="Chemical Engineering">Chemical Engineering</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Civil Engineering">Civil Engineering</option>
                                    <option value="Climate Studies">Climate Studies</option>
                                    <option value="Computer Centre (CC)">Computer Centre (CC)</option>
                                    <option value="Computer Science & Engineering">Computer Science & Engineering</option>
                                    <option value="Dean Academic Programme (Dean AP)">Dean Academic Programme (Dean AP)</option>
                                    <option value="Dean Alumni Corporate Relations (Dean ACR)">Dean Alumni Corporate Relations (Dean ACR)</option>
                                    <option value="Dean Educational Outreach (Dean EO)">Dean Educational Outreach (Dean EO)</option>
                                    <option value="Dean Faculty">Dean Faculty</option>
                                    <option value="Dean Finance & Infra (Dean FIA)">Dean Finance & Infra (Dean FIA)</option>
                                    <option value="Dean Infrastructure Planning Support (Dean IPS)">Dean Infrastructure Planning Support (Dean IPS)</option>
                                    <option value="Dean International Relation (Dean IR)">Dean International Relation (Dean IR)</option>
                                    <option value="Dean RnD (IRCC)">Dean RnD (IRCC)</option>
                                    <option value="Dean Strategy">Dean Strategy</option>
                                    <option value="Dean Student Affairs (Dean SA)">Dean Student Affairs (Dean SA)</option>
                                    <option value="Deputy Director ART (DD ART)">Deputy Director ART (DD ART)</option>
				                    <option value="Deputy Director (DD FEA)">Deputy Director (DD FEA)</option>
                                    <option value="Deputy Registrar Academic (DR Acad)">Deputy Registrar Academic (DR Acad)</option>
                                    <option value="Deputy Registrar Admin (DR Admin)">Deputy Registrar Admin (DR Admin)</option>
                                    <option value="Deputy Registrar Finance & Accounts (DR F&A)">Deputy Registrar Finance & Accounts (DR F&A)</option>
                                    <option value="Deputy Registrar Material Management Division (DR MMD)">Deputy Registrar Material Management Division (DR MMD)</option>
                                    <option value="Desai Sethi School of Entrepreneurship (DSSE)">Desai Sethi School of Entrepreneurship (DSSE)</option>
				                    <option value="Directors Office">Directors Office</option>
                                    <option value="DRDO-Industry-Academia Centre of Excellence (DIA-CoE)">DRDO-Industry-Academia Centre of Excellence (DIA-CoE)</option>
                                    <option value="Earth Sciences">Earth Sciences</option>
                                    <option value="Economics">Economics</option>
                                    <option value="Educational Technology">Educational Technology</option>
                                    <option value="Electrical Engineering">Electrical Engineering</option>
                                    <option value="Electrical Maintenance Division (EMD)">Electrical Maintenance Division (EMD)</option>
                                    <option value="Energy Science and Engineering">Energy Science and Engineering</option>
                                    <option value="Environmental Science and Engineering (ESED)">Environmental Science and Engineering (ESED)</option>
                                    <option value="Estate Office">Estate Office</option>
                                    <option value="Gate Office">Gate Office</option>
                                    <option value="General Admin">General Admin</option>
                                    <option value="Geospatial Information Science and Engineering">Geospatial Information Science and Engineering</option>
                                    <option value="GMP (Good Manufacturing Practice) Lab">GMP (Good Manufacturing Practice) Lab</option>
                                    <option value="Green Energy and Sustainability Hub">Green Energy and Sustainability Hub</option>
                                    <option value="HDFC-Ergo IIT Bombay (HE-IITB) Innovation Lab">HDFC-Ergo IIT Bombay (HE-IITB) Innovation Lab</option>
                                    <option value="Hostel Coordinating Unit (HCU)">Hostel Coordinating Unit (HCU)</option>
                                    <option value="Humanities and Social Science (HSS)">Humanities and Social Science (HSS)</option>
                                    <option value="IDC School of Design (IDC SoD)">IDC School of Design (IDC SoD)</option>
                                    <option value="IIT Bombay Development and Relations Foundation (IITB-DRF)">IIT Bombay Development and Relations Foundation (IITB-DRF)</option>
                                    <option value="IIT Bombay FedEx Centre for Advanced Logistics and Analytics">IIT Bombay FedEx Centre for Advanced Logistics and Analytics</option>
                                    <option value="IITB Trust Lab">IITB Trust Lab</option>
                                    <option value="IITB-Monash Research Academy (Section 8 Company)">IITB-Monash Research Academy (Section 8 Company)</option>
                                    <option value="IITB-Research Park Foundation (IITB-RPF)">IITB-Research Park Foundation (IITB-RPF)</option>
                                    <option value="Industrial Engineering and Operations Research (IEOR)">Industrial Engineering and Operations Research (IEOR)</option>
                                    <option value="Institute of Eminence (IOE)">Institute of Eminence (IOE)</option>
                                    <option value="Jalvihar Guest House">Jalvihar Guest House</option>
                                    <option value="JEE Office">JEE Office</option>
                                    <option value="Koita Centre for Digital Health (KCDH)">Koita Centre for Digital Health (KCDH)</option>
                                    <option value="Legal Cell">Legal Cell</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                                    <option value="Metallurgical Engineering & Materials Science (MEMS)">Metallurgical Engineering & Materials Science (MEMS)</option>
                                    <option value="National Centre for Mathematics (NCM)">National Centre for Mathematics (NCM)</option>
                                    <option value="National Centre for Photovoltaic Research and Education (NCPRE)">National Centre for Photovoltaic Research and Education (NCPRE)</option>
                                    <option value="National Centre of Excellence in Carbon Capture and Utilization (NCoE-CCU)">National Centre of Excellence in Carbon Capture and Utilization (NCoE-CCU)</option>
                                    <option value="National Centre of Excellence in Technology for Internal Security (NCETIS)">National Centre of Excellence in Technology for Internal Security (NCETIS)</option>
                                    <option value="Padmavihar Guest House">Padmavihar Guest House</option>
                                    <option value="Parimal and Pramod Chaudhari Centre for Learning and Teaching (PPCCLT)">Parimal and Pramod Chaudhari Centre for Learning and Teaching (PPCCLT)</option>
                                    <option value="Photovoltaics Technology and Innovation Centre (PoTIC)">Photovoltaics Technology and Innovation Centre (PoTIC)</option>
                                    <option value="Physics">Physics</option>
                                    <option value="SBI Foundation Hub for Data Science and Analytics">SBI Foundation Hub for Data Science and Analytics</option>
                                    <option value="Security Office">Security Office</option>
                                    <option value="Society for Innovation and Entrepreneurship (SINE)">Society for Innovation and Entrepreneurship (SINE)</option>
                                    <option value="Sophisticated Analytical Instrument Facility (SAIF)">Sophisticated Analytical Instrument Facility (SAIF)</option>
                                    <option value="Sunita Sanghi Centre of Ageing and Neurodegenerative Diseases (SCAN)">Sunita Sanghi Centre of Ageing and Neurodegenerative Diseases (SCAN)</option>
                                    <option value="Tata Centre for Technology and Design (TCTD)">Tata Centre for Technology and Design (TCTD)</option>
                                    <option value="Technocraft Centre for Applied Artificial Intelligence (TCAAI)">Technocraft Centre for Applied Artificial Intelligence (TCAAI)</option>
                                    <option value="Technology Innovation Hub Foundation for IoT and IoE (TIH-IoT)">Technology Innovation Hub Foundation for IoT and IoE (TIH-IoT)</option>
                                    <option value="Vanvihar Guest House">Vanvihar Guest House</option>
                                    <option value="Wadhwani Research Centre for Bioengineering (WRCB)">Wadhwani Research Centre for Bioengineering (WRCB)</option>
                                    <option value="Water Innovation Centre: Technology, Research and Education (WICTRE)">Water Innovation Centre: Technology, Research and Education (WICTRE)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Send Date</label>
                                <input type="date" class="form-control sendOrReceiveDate" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Description</label>
                                <textarea class="form-control description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload PDF Document</label>
                                <input type="file" class="form-control attachment" name="attachment" accept=".pdf" required>
                            </div>
                            <button type="submit" class="btn btn-danger">Submit Outgoing Document</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable -->
        <div class="row">
            <table id="oldrecords" class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Num</th>
                        <th>Department</th>
                        <th>Description</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- PDF Viewer Modal -->
    <div class="modal fade" id="pdfViewerModal" tabindex="-1" aria-labelledby="pdfViewerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfViewerModalLabel">Document Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfIframe" src="" width="100%" height="600" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" id="downloadPdfLink" class="btn btn-primary" download>Download</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table; // Declare table as a global variable

        var refreshTable = function() {
            if ($.fn.DataTable.isDataTable('#oldrecords')) {
                $('#oldrecords').DataTable().destroy();
            }
            
            // Reinitialize the table
            table = $('#oldrecords').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "assets/php/records.php",
                    type: "POST",
                    error: function(xhr, status, error) {
                        console.error("DataTables error:", error);
                        alert("Unable to load data. Please try again later.");
                    }
                },
                columns: [
                    { data: 'date' },
                    { 
                        data: 'type',
                        render: function(data, type, row) {
                            if (row.type === 'incoming') {
                                return '<img src="assets/logos/inbox.svg" alt="Incoming" width="24" height="24" class="mr-2">';
                            } else if (row.type === 'outgoing') {
                                return '<img src="assets/logos/outbox.svg" alt="Outgoing" width="24" height="24" class="mr-2">';
                            }
                            return data;
                        }
                    },
                    { data: 'dname' },
                    { data: 'ucode',
                        render: function(data, type, row) {
                            if (row.type === 'incoming') {
                                return `<span class="badge bg-success">${data}</span>`;
                            } else if (row.type === 'outgoing') {
                                return `<span class="badge bg-danger">${data}</span>`;
                            }
                            return data;
                        }
                    },
                    { data: 'srcdes' },
                    { data: 'remarks' },
                    { 
                        data: 'link',
                        render: function (data, type, row) {
                            return `<button class="btn btn-sm btn-primary view-pdf" data-url="uploads/${data}">View</button>`;
                        }
                    }
                ]
            });

            // Event delegation for view PDF button
            $('#oldrecords').off('click', '.view-pdf').on('click', '.view-pdf', function() {
                var pdfUrl = $(this).data('url');
                
                // Set iframe src to the PDF URL
                $('#pdfIframe').attr('src', pdfUrl);
                
                // Set download link
                $('#downloadPdfLink').attr('href', pdfUrl);
                
                // Show the modal
                var pdfModal = new bootstrap.Modal(document.getElementById('pdfViewerModal'));
                pdfModal.show();
            });
        }

        $(document).ready(function () {
        var today = new Date().toISOString().split('T')[0];
        $('.sendOrReceiveDate').val(today);

        // Initialize DataTable
        refreshTable();

        // Form Submission
        $('.documentForm').on('submit', function (e) {
            e.preventDefault();

            var form = $(this);
            var formType = form.data('form-type');

            // Create a FormData object for file upload
            var formData = new FormData(form[0]);
            formData.append('formType', formType);
            formData.append('docType', form.find('.docType').val());
            formData.append('senderOrRecipient', form.find('.senderOrRecipient').val());
            formData.append('sendOrReceiveDate', form.find('.sendOrReceiveDate').val());
            formData.append('description', form.find('.description').val());

            // AJAX Call
            $.ajax({
                url: 'assets/php/backend.php',
                type: 'POST',
                data: formData,
                contentType: false, // Important for file uploads
                processData: false, // Prevent jQuery from processing the data
                success: function (response) {
                    alert(response);
                    console.log(response);
                    form[0].reset();

                    // Reload the table data
                    table.ajax.reload(null, false); // false keeps the current page

                    $('.sendOrReceiveDate').val(today);
                },
                error: function () {
                    alert("There was an error processing the request.");
                }
            });
        });
    });

    </script>
</body>
</html>
