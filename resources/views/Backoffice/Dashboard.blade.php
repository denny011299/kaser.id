@extends('Backoffice.Layout')
@section('body')
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
                    </div>
                </div>
                
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12 col-xl-4">
                        <div class="row g-3">
                            <div class="col-md-12 col-xl-12">
                                <div class="card bg-primary-subtle overflow-hidden mb-0">
                                    <div class="card-body">
                                        <div class="d-flex align-content-center justify-content-between">
                                            <div class="d-flex align-items-start flex-column h-100">
                                                <h3 class="text-dark fw-semibold fs-20 lh-base mx-auto mb-3">Upgrade you plan for 
                                                <br>Great experience</h3>
                                                <a href="#" class="btn btn-sm btn-danger">Upgarde Now</a>
                                            </div>
                                            <div class="">
                                                <img src="assets/images/widget/girls.png" alt="" class=" mb-n3 float-end"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="d-flex mb-2">
                                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#c26316" d="M6.444 3.685a10 10 0 0 1 1.662-.896c1.403-.593 2.104-.89 3-.296C12 3.086 12 4.057 12 6v2c0 1.886 0 2.828.586 3.414S14.114 12 16 12h2c1.942 0 2.914 0 3.507.895s.297 1.596-.296 3a10 10 0 0 1-11.162 5.913A10 10 0 0 1 6.444 3.685"/><path fill="#060707" fill-rule="evenodd" d="M13.774 2.128a.75.75 0 0 1 .913-.54a10.77 10.77 0 0 1 7.725 7.725a.75.75 0 0 1-1.453.374a9.27 9.27 0 0 0-6.646-6.646a.75.75 0 0 1-.54-.913" clip-rule="evenodd" opacity="0.5"/></svg>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fs-16 mb-1">Website Traffic</div>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-dark">91.6K</div>
                                            <div class="me-auto">
                                                <span class="text-primary d-inline-flex align-items-center">
                                                    15%
                                                    <i data-feather="trending-up" class="ms-1" style="height: 20px; width: 20px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div id="website-traffic" class="apex-charts"></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="d-flex mb-2">
                                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#E7366B" fill-rule="evenodd" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10m.75-16a.75.75 0 0 0-1.5 0v.317c-1.63.292-3 1.517-3 3.183c0 1.917 1.813 3.25 3.75 3.25c1.377 0 2.25.906 2.25 1.75s-.873 1.75-2.25 1.75c-1.376 0-2.25-.906-2.25-1.75a.75.75 0 0 0-1.5 0c0 1.666 1.37 2.891 3 3.183V18a.75.75 0 0 0 1.5 0v-.317c1.63-.292 3-1.517 3-3.183c0-1.917-1.813-3.25-3.75-3.25c-1.376 0-2.25-.906-2.25-1.75s.874-1.75 2.25-1.75c1.377 0 2.25.906 2.25 1.75a.75.75 0 0 0 1.5 0c0-1.666-1.37-2.891-3-3.183z" clip-rule="evenodd"/></svg>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fs-16 mb-1">Conversion Rate</div>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-dark">15%</div>
                                            <div class="me-auto">
                                                <span class="text-danger d-inline-flex align-items-center">
                                                    10%
                                                    <i data-feather="trending-down" class="ms-1" style="height: 20px; width: 20px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div id="conversion-visitors" class="apex-charts"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex mb-2">
                                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#287F71" fill-rule="evenodd" d="M12 22c4.836 0 8.757-3.884 8.757-8.675c0-4.79-3.92-8.674-8.757-8.674s-8.757 3.883-8.757 8.674S7.163 22 12 22m0-13.253c.403 0 .73.324.73.723v3.556l2.218 2.198a.72.72 0 0 1 0 1.022a.735.735 0 0 1-1.032 0l-2.432-2.41a.72.72 0 0 1-.214-.51V9.47c0-.4.327-.723.73-.723M8.24 2.34a.72.72 0 0 1-.232.996l-3.891 2.41a.734.734 0 0 1-1.006-.23a.72.72 0 0 1 .232-.996l3.892-2.41a.734.734 0 0 1 1.006.23m7.519 0a.734.734 0 0 1 1.005-.23l3.892 2.41a.72.72 0 0 1 .232.996a.734.734 0 0 1-1.006.23l-3.891-2.41a.72.72 0 0 1-.233-.996" clip-rule="evenodd"/></svg>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fs-16 mb-1">Session Duration</div>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-dark">90 Sec</div>
                                            <div class="me-auto">
                                                <span class="text-primary d-inline-flex align-items-center">
                                                    25%
                                                    <i data-feather="trending-up" class="ms-1" style="height: 20px; width: 20px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div id="session-duration" class="apex-charts"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex mb-2">
                                            <div class="rounded-2 bg-white p-1 shadow-sm border">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#108dff" fill-rule="evenodd" d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991zM14 9a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8c4 0 4-.895 4-2s-1.79-2-4-2s-4 .895-4 2s0 2 4 2" clip-rule="evenodd"/></svg>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fs-16 mb-1">Active Users</div>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-dark">2,986</div>
                                            <div class="me-auto">
                                                <span class="text-primary d-inline-flex align-items-center">
                                                    4%
                                                    <i data-feather="trending-up" class="ms-1" style="height: 20px; width: 20px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div id="active-users" class="apex-charts"></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end sales -->
                    <!-- Start Earning Reports -->
                    <div class="col-md-12 col-xl-8">
                        <div class="bg-light rounded p-3 mb-3 border">
                            <div class="row gap-2 gap-sm-0">
                                <div class="col-12 col-sm-4">
                                    <div class="earnings-section">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="bg-success-subtle rounded-2 p-1 me-2 border border-dashed border-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><g fill="none">
                                                    <path d="M0 0h48v48H0z"/><path fill="#287F71" fill-rule="evenodd" d="M24 7a1 1 0 0 0-1 1v3h-1a7 7 0 1 0 0 14h1v10h-1a5 5 0 0 1-4.716-3.333a1 1 0 1 0-1.885.666A7 7 0 0 0 22 37h1v3a1 1 0 1 0 2 0v-3h1a7 7 0 1 0 0-14h-1V13h1a5 5 0 0 1 4.716 3.333a1 1 0 1 0 1.885-.666A7 7 0 0 0 26 11h-1V8a1 1 0 0 0-1-1m-3 1a3 3 0 1 1 6 0v1.055A9.01 9.01 0 0 1 34.487 15a3 3 0 1 1-5.657 2A3 3 0 0 0 27 15.17v5.885a9.001 9.001 0 0 1 0 17.89V40a3 3 0 1 1-6 0v-1.055A9.01 9.01 0 0 1 13.513 33a3 3 0 1 1 5.657-2A3 3 0 0 0 21 32.83v-5.885a9.001 9.001 0 0 1 0-17.89zm-4 10a5 5 0 0 1 5-5h1v10h-1a5 5 0 0 1-5-5m4-2.83a3.001 3.001 0 0 0 0 5.66zM25 25h1a5 5 0 0 1 0 10h-1zm2 2.17v5.66a3.001 3.001 0 0 0 0-5.66" clip-rule="evenodd"/></g>
                                                </svg>
                                            </div>
                                            <h6 class="mb-0 fw-normal fs-16">Earnings</h6>
                                        </div>
                                        <h4 class="my-2 text-dark">$545.69</h4>
                                        <div class="progress w-75" style="height:6px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="earnings-profit border-start border-dashed border-primary-subtle mt-md-0 mt-2">
                                        <div class="ms-md-3">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="bg-primary-subtle rounded-2 p-1 me-2 border border-dashed border-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="#108dff" fill-rule="evenodd" clip-rule="evenodd">
                                                        <path d="M17.206 1.856c-1.063-.419-2.09-.135-2.817.512c-.71.63-1.139 1.602-1.139 2.632v4c0 .967.784 1.75 1.75 1.75h4c1.03 0 2.002-.43 2.633-1.139c.646-.727.93-1.754.51-2.817a8.776 8.776 0 0 0-4.937-4.938M14.75 9V5c0-.627.265-1.182.636-1.512c.353-.314.791-.425 1.27-.236a7.276 7.276 0 0 1 4.092 4.092c.189.479.078.917-.236 1.27c-.33.371-.885.636-1.512.636h-4a.25.25 0 0 1-.25-.25"/><path d="M10.995 2.87c-.61-.396-1.2-.51-1.85-.396c-.55.096-1.14.36-1.767.641l-.067.03A10.25 10.25 0 1 0 20.855 16.69l.03-.068c.281-.627.545-1.217.641-1.768c.113-.648 0-1.239-.396-1.85c-.426-.657-1.01-.979-1.724-1.125c-.634-.13-1.426-.13-2.334-.129H15.5c-.964 0-1.612-.002-2.095-.066c-.461-.063-.659-.17-.789-.3c-.13-.13-.237-.328-.3-.79c-.064-.482-.066-1.13-.066-2.094V6.928c0-.908 0-1.7-.13-2.334c-.145-.714-.467-1.298-1.125-1.724M7.924 4.514c.719-.322 1.136-.503 1.48-.563c.265-.046.474-.018.776.178c.254.165.389.361.471.765c.095.467.099 1.104.099 2.106v1.552c0 .898 0 1.648.08 2.242c.084.628.27 1.195.726 1.65c.455.456 1.022.642 1.65.726c.594.08 1.344.08 2.242.08H17c1.002 0 1.639.004 2.106.099c.404.082.6.217.765.471c.196.302.224.511.178.777c-.06.343-.241.76-.563 1.48a8.755 8.755 0 0 1-4.638 4.507a8.75 8.75 0 0 1-6.924-16.07"/></g>
                                                    </svg>
                                                </div>
                                                <h6 class="mb-0 fw-normal fs-16">Profit</h6>
                                            </div>
                                            <h4 class="my-2 text-dark">$256.34</h4>
                                            <div class="progress w-75" style="height:6px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-4">
                                    <div class="earnings-expense border-start border-dashed border-primary-subtle mt-md-0 mt-2">
                                        <div class="ms-md-3">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="bg-secondary-subtle rounded-2 p-1 me-2 border border-dashed border-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 15 15"><g fill="none" stroke="#963b68" stroke-linejoin="round">
                                                        <path d="M.5 12.5h4l1-4h1.795a4.625 4.625 0 0 0 4.33-3.001C12.532 3.08 10.745.5 8.161.5H3.5z"/><path d="M4 14.5h4L9 11h1.577c1.477 0 2.82-.859 3.438-2.2c.927-2.008-.54-4.3-2.75-4.3H6.5z"/></g>
                                                    </svg>
                                                </div>
                                                <h6 class="mb-0 fw-normal fs-16">Expense</h6>
                                            </div>
                                            <h4 class="my-2 text-dark">$74.19</h4>
                                            <div class="progress w-75" style="height:6px">
                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0">Earning Reports</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="monthly-sales" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
                <!-- Start Wdget Component -->
                <div class="row">
                    <!-- Start Traffic Source -->
                    <div class="col-md-12 col-xl-4">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0">Traffic Source</h5>
                                </div>
                            </div>
                            <div class="card-body mt-0">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th>Browser</th>
                                                <th>Sessions</th>
                                                <th>Traffic</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="avatar rounded-circle avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#108dff" d="M12.222 5.977a5.4 5.4 0 0 1 3.823 1.496l2.868-2.868A9.6 9.6 0 0 0 12.222 2a10 10 0 0 0-8.937 5.51l3.341 2.59a5.96 5.96 0 0 1 5.596-4.123" opacity="0.7"/><path fill="#108dff" d="M3.285 7.51a10.01 10.01 0 0 0 0 8.98l3.341-2.59a5.9 5.9 0 0 1 0-3.8z"/><path fill="#108dff" d="M15.608 17.068A6.033 6.033 0 0 1 6.626 13.9l-3.34 2.59A10 10 0 0 0 12.221 22a9.55 9.55 0 0 0 6.618-2.423z" opacity="0.5"/><path fill="#108dff" d="M21.64 10.182h-9.418v3.868h5.382a4.6 4.6 0 0 1-1.996 3.018l-.01.006l.01-.006l3.232 2.51a9.75 9.75 0 0 0 2.982-7.35q0-1.032-.182-2.046" opacity="0.25"/></svg>
                                                        </span>
                                                        <h6 class="mb-0 fs-14">Google</h6>   
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fs-14"><i class="mdi mdi-arrow-up me-1 text-success align-middle fs-16"></i>45,379</span>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-0">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="avatar rounded-circle avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 128 128"><path fill="#1e64f0" d="M64 1.5C29.5 1.5 1.5 29.5 1.5 64s28 62.5 62.5 62.5s62.5-28 62.5-62.5S98.5 1.5 64 1.5m56 57.9l-5 .4l-.1-1l5-.4zm0 3.6v1h-9v-1zm-.6-8.4l-9.1 1.6l-.2-1l9.1-1.6zm-1-4.8l-4.9 1.3l-.3-1l4.9-1.3zm-1.4-4.7l-8.6 3.2l-.3-.9l8.6-3.2zm-1.8-4.6l-4.5 2.1l-.4-.9l4.5-2.1zm-2.3-4.3l-8 4.6l-.5-.9l8-4.6zm-3.1-5l.6.8l-4.1 2.9l-.6-.8zm-2.4-3.1l-7.1 5.9l-.6-.8l7.1-5.9zm-6.9-7l-5.9 7.1l-.8-.6l5.9-7.1zm-4.7-3.6l.8.6l-2.9 4.1l-.8-.6zm-3.2-2.1l-4.6 8l-.9-.5l4.6-8zm-5.3-2.7l.9.4l-2.1 4.5l-.9-.4zm-4.5-1.8l.9.3l-3.2 8.6l-.9-.3zm-4.7-1.5l1 .3l-1.3 4.9l-1-.3zm-4.8-1l1 .2l-1.6 9.1l-1-.2zm-4.9-.6l1 .1l-.4 5l-1-.1zM63 8h1v9h-1zm-3.4-.2l.4 5l-1 .1l-.4-5zm-4.9.6l1.6 9.1l-1 .2l-1.6-9.1zm-4.8 1l1.3 4.9l-1 .3L49 9.7zm-4.7 1.5l3.2 8.6l-.9.3l-3.2-8.6zm-4.5 1.8l2.1 4.5l-.9.4l-2.1-4.5zm-4.4 2.2l4.6 8l-.9.5l-4.6-8zm-4.1 2.6l2.9 4.1l-.8.6l-2.9-4.1zm-3.9 3l5.9 7.1l-.8.6l-5.9-7.1zm-3.7 3.2l3.5 3.5l-.7.8l-3.5-3.5zm-3.4 3.6l7.1 5.9l-.6.8l-7.1-5.9zm-3 3.9l4.1 2.9l-.6.8l-4.1-2.9zm-2.6 4.1l8 4.6l-.6.9l-8-4.6zm-2.3 4.3l4.5 2.1l-.4.9l-4.5-2.1zm-1.9 4.6l8.6 3.2l-.3.9l-8.7-3.2zm-1.6 4.6l4.9 1.3l-.3 1l-4.9-1.3zm-1.1 4.8l9.1 1.6l-.2 1l-9.1-1.6zM8 58.5l5 .4l-.1 1l-5-.4zm9 4.5v1H8v-1zm-9 5.3l5-.4l.1 1l-5 .4zm.6 4.8l9.1-1.6l.2 1l-9.1 1.6zm1 4.8l4.9-1.3l.3 1l-4.9 1.3zm1.4 4.7l8.6-3.2l.3.9l-8.6 3.2zm1.8 4.6l4.5-2.1l.4.9l-4.5 2.1zm2.3 4.4l8-4.6l.5.9l-8 4.6zm3.1 4.9l-.6-.8l4.1-2.9l.6.8zm9.5-2.8l.6.8l-7.1 5.9l-.6-.8zm-.2 12.9l5.9-7.1l.8.6l-5.9 7.1zm4.7 3.6l-.8-.6l2.9-4.1l.8.6zm3.2 2.1l4.6-8l.9.5l-4.6 8zm5.3 2.7l-.9-.4l2.1-4.5l.9.4zm4.5 1.9l-.9-.3l3.2-8.6l.9.3zm4.7 1.4l-1-.3l1.3-4.9l1 .3zm4.8 1l-1-.2l1.6-9.1l1 .2zm4.9.6l-1-.1l.4-5l1 .1zm4.4.1h-1v-9h1zm4.4-.1l-.4-5l1-.1l.4 5zM21 106.7l37.7-48l48-37.7l-36.8 48.9zm52.3 12.6l-1.6-9.1l1-.2l1.6 9.1zm4.8-1l-1.3-4.9l1-.3L79 118zm4.7-1.4l-3.2-8.6l.9-.3l3.2 8.6zm4.5-1.9l-2.1-4.5l.9-.4l2.1 4.5zm4.4-2.2l-4.6-8l.9-.5l4.6 8zm4.1-2.6l-2.9-4.1l.8-.6l2.9 4.1zm3.9-2.9l-5.9-7.1l.8-.6l5.9 7.1zm3.7-3.3l-3.5-3.5l.7-.7l3.5 3.5zm3.4-3.6l-7.1-5.9l.6-.8l7.1 5.9zm3-3.9l-4.1-2.9l.6-.8l4.1 2.9zm2.6-4.1l-8-4.6l.5-.9l8 4.6zm2.3-4.3l-4.5-2.1l.4-.9l4.5 2.1zm1.9-4.5l-8.6-3.2l.3-.9l8.6 3.2zm1.6-4.7l-4.9-1.3l.3-1l4.9 1.3zm1.1-4.8l-9.1-1.6l.2-1l9.1 1.6zm.7-4.8l-5-.4l.1-1l5 .4z"/></svg>
                                                        </span>
                                                        <h6 class="mb-0 fs-14">Safari</h6>   
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fs-14"><i class="mdi mdi-arrow-up me-1 text-success align-middle fs-16"></i>78,379</span>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-0">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 32%" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="avatar rounded-circle avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#522c8f" d="M10.86 15.37c-.69-.77-1.16-1.69-1.31-2.72c-.3.46-.55.96-.73 1.5c-.92 2.75.68 6.18 3.4 7.18c2.34.78 4.97-.61 6.7-2.13c.26-.35 2.31-2.16 1.29-2.36c-3.02 1.55-7.02 1.11-9.35-1.47m.6-5.81c1.04-.01.04-.43-.39-.75c-1.04-.57-2.26-.85-3.44-.85C3.78 8 .995 10.41 2.3 14.4c.94 3.88 4.31 7 8.29 7.5c-2.05-1.29-3.29-3.71-3.29-6.12c.08-2.53 1.64-5.5 4.16-6.22M2.78 8.24C5.82 6 10.66 6.18 13.28 9c1.02 1.11 1.72 3 .79 4.37c-1.74 1.88 3.08 2.13 4.11 1.85c3.74-.72 4.73-5.07 2.95-8.07c-1.7-3.4-5.47-5.18-9.17-5.15c-4.06-.07-7.71 2.5-9.18 6.24"/></svg>
                                                        </span>
                                                        <h6 class="mb-0 fs-14">Edge</h6> 
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fs-14"><i class="mdi mdi-arrow-down me-1 text-danger align-middle fs-16"></i>12,457</span>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-0">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 21%" aria-valuenow="21" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="avatar rounded-circle avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#963b68" d="M11.996 2c-5.462 0-9.278 3.958-9.278 9.899C2.718 17.189 6.43 22 12.004 22c5.567 0 9.278-4.819 9.278-10.101c0-5.94-3.824-9.899-9.286-9.899m0 18.384c-3.397 0-3.77-5.013-3.77-8.71V11.6c0-3.996.598-8.23 3.748-8.23s3.786 4.361 3.786 8.357c0 3.696-.367 8.657-3.764 8.657"/></svg>
                                                        </span>
                                                        <h6 class="mb-0 fs-14">Opera</h6>   
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fs-14"><i class="mdi mdi-arrow-up me-1 text-success align-middle fs-16"></i>6,570</span>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-0">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="avatar rounded-circle avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="#287F71" d="m19.971 6.676l-.231 1.422s-.332-2.633-.737-3.617c-.622-1.508-.899-1.496-.9-1.494c.416 1.013.34 1.558.34 1.558s-.737-1.925-2.689-2.538c-2.162-.678-3.331-.492-3.466-.458h-.06l.048.004l-.002.001c.009.01 2.389.398 2.81.954c0 0-1.01 0-2.016.277c-.046.013 3.701.448 4.467 4.031c0 0-.41-.82-.919-.959c.334.973.249 2.818-.07 3.735c-.04.118-.082-.51-.71-.78c.202 1.376-.011 3.56-1.01 4.161c-.077.047.626-2.155.143-1.304c-2.788 4.09-6.082 1.887-7.564.918c.76.158 2.2-.024 2.838-.479l.002-.001c.693-.453 1.103-.785 1.472-.706c.368.079.614-.275.327-.59s-.983-.747-1.924-.51c-.664.166-1.487.869-2.743.157c-.964-.547-1.055-1.001-1.064-1.316q.036-.166.09-.31c.11-.297.447-.387.634-.457c.318.052.591.147.878.288a5 5 0 0 0 0-.35c.028-.053.01-.21-.034-.404a3 3 0 0 0-.132-.574l.004-.002l.004-.003v-.001l.005-.009c.02-.086.235-.253.502-.432c.24-.16.522-.33.744-.463c.196-.116.346-.203.378-.226l.042-.03l.009-.007l.006-.004a.74.74 0 0 0 .296-.553v-.002l.003-.029l.001-.02l.001-.017l.001-.038v-.003a1 1 0 0 0-.008-.149v-.002l-.001-.005l-.003-.008l-.003-.01c-.035-.077-.163-.105-.693-.114h-.001a50 50 0 0 0-.87-.003c-.649.003-1.008-.607-1.122-.843c.157-.831.61-1.423 1.356-1.825q.02-.012-.005-.018c.146-.085-1.763-.003-2.64 1.066c-.78-.186-1.458-.173-2.043-.042a2.5 2.5 0 0 1-.42-.049c-.388-.338-.946-.96-.975-1.705l-.005.004l-.002-.022s-1.186.873-1.008 3.25l-.002.11c-.321.417-.48.767-.492.844C.523 6.53.235 7.363 0 8.63c0 0 .164-.498.494-1.063c-.242.711-.433 1.816-.321 3.474c0 0 .03-.367.134-.897c.082 1.028.44 2.298 1.345 3.79c1.737 2.866 4.407 4.313 7.359 4.535a10.5 10.5 0 0 0 1.59.004l.148-.011q.909-.059 1.821-.269c8.304-1.92 7.401-11.517 7.401-11.517"/></svg>
                                                        </span>
                                                        <h6 class="mb-0 fs-14">Firefox</h6>   
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fs-14"><i class="mdi mdi-arrow-down me-1 text-danger align-middle fs-16"></i>6,568</span>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-0">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="avatar rounded-circle avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><g fill="none" stroke="#c26316" stroke-linecap="round" stroke-linejoin="round"><circle cx="19.584" cy="35.252" r="7.248"/><path d="M29.384 38.58s5.985-1.098 5.985 3.92H16.524c-6.184 0-11.197-5.013-11.197-11.197c0-2.9 1.1-5.548 2.914-7.533c3.51-3.84 5.1-5.194 5.1-8.375s-3.953-5.124-8.014-2.65C8.806 6.678 11.574 5.5 17.228 5.5s8.305 4.712 8.305 8.835c0 8.187-13.197 8.894-13.197 20.917"/><path d="M29.384 38.58a9.131 9.131 0 0 0-15.58-9.521"/><path d="M18.141 25.52c5.272-3.705 12.575-2.233 17.228 2.185c5.36-.943 7.304 2.356 7.304 2.356c-2.28-.178-5.034.656-6.854 1.343a3.04 3.04 0 0 1-3.336-.79c-3.593-3.961-9.133-7.585-14.342-5.093"/><path d="M22.98 23.573s2.789-2.863 8.973-6.175c-.236-3.004-.088-4.13 1.414-5.066c2.65.67 3.18 3.829 3.18 3.829c4.889 1.649 6.832 8.304 5.007 9.247s-7.741.256-11.353-.98"/></g><path fill="none" stroke="#c26316" stroke-linecap="round" stroke-linejoin="round" d="M19.44 31.252V38.1c0 .635.516 1.15 1.152 1.15h.345m-2.705-6.099h2.417"/></svg>
                                                        </span>
                                                        <h6 class="mb-0 fs-14">UC Browser</h6>   
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fs-14"><i class="mdi mdi-arrow-up me-1 text-success align-middle fs-16"></i>4,800</span>
                                                </td>
                                                <td>
                                                    <div class="progress progress-sm mt-0">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Sales By Countries -->
                    <div class="col-md-12 col-xl-4">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0">Sales by Countries</h5>
                                    <div class="ms-auto"> 
                                        <button class="btn btn-sm bg-light border dropdown-toggle fw-medium" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View All<i class="mdi mdi-chevron-down ms-1 fs-14"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Today</a>
                                            <a class="dropdown-item" href="#">This Week</a>
                                            <a class="dropdown-item" href="#">Last Week</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="p-0 m-0">
                                    <li class="d-flex align-items-center mb-3">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3 d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 64">
                                                <path fill="#ed4c5c" d="M48 6.6C43.3 3.7 37.9 2 32 2v4.6z"/><path fill="#fff" d="M32 11.2h21.6C51.9 9.5 50 7.9 48 6.6H32z"/><path fill="#ed4c5c" d="M32 15.8h25.3c-1.1-1.7-2.3-3.2-3.6-4.6H32z"/><path fill="#fff" d="M32 20.4h27.7c-.7-1.6-1.5-3.2-2.4-4.6H32z"/><path fill="#ed4c5c" d="M32 25h29.2c-.4-1.6-.9-3.1-1.5-4.6H32z"/><path fill="#fff" d="M32 29.7h29.9c-.1-1.6-.4-3.1-.7-4.6H32z"/><path fill="#ed4c5c" d="M61.9 29.7H32V32H2c0 .8 0 1.5.1 2.3h59.8c.1-.8.1-1.5.1-2.3c0-.8 0-1.6-.1-2.3"/><path fill="#fff" d="M2.8 38.9h58.4c.4-1.5.6-3 .7-4.6H2.1c.1 1.5.3 3.1.7 4.6"/><path fill="#ed4c5c" d="M4.3 43.5h55.4c.6-1.5 1.1-3 1.5-4.6H2.8c.4 1.6.9 3.1 1.5 4.6"/><path fill="#fff" d="M6.7 48.1h50.6c.9-1.5 1.7-3 2.4-4.6H4.3c.7 1.6 1.5 3.1 2.4 4.6"/><path fill="#ed4c5c" d="M10.3 52.7h43.4c1.3-1.4 2.6-3 3.6-4.6H6.7c1 1.7 2.3 3.2 3.6 4.6"/><path fill="#fff" d="M15.9 57.3h32.2c2.1-1.3 3.9-2.9 5.6-4.6H10.3c1.7 1.8 3.6 3.3 5.6 4.6"/><path fill="#ed4c5c" d="M32 62c5.9 0 11.4-1.7 16.1-4.7H15.9c4.7 3 10.2 4.7 16.1 4.7"/><path fill="#428bc1" d="M16 6.6c-2.1 1.3-4 2.9-5.7 4.6c-1.4 1.4-2.6 3-3.6 4.6c-.9 1.5-1.8 3-2.4 4.6c-.6 1.5-1.1 3-1.5 4.6c-.4 1.5-.6 3-.7 4.6c-.1.8-.1 1.6-.1 2.4h30V2c-5.9 0-11.3 1.7-16 4.6"/><path fill="#fff" d="m25 3l.5 1.5H27l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm4 6l.5 1.5H31l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm-8 0l.5 1.5H23l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm4 6l.5 1.5H27l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm-8 0l.5 1.5H19l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm-8 0l.5 1.5H11l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm20 6l.5 1.5H31l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm-8 0l.5 1.5H23l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm-8 0l.5 1.5H15l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm12 6l.5 1.5H27l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm-8 0l.5 1.5H19l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm-8 0l.5 1.5H11l-1.2 1l.4 1.5l-1.2-.9l-1.2.9l.4-1.5l-1.2-1h1.5zm2.8-14l1.2-.9l1.2.9l-.5-1.5l1.2-1h-1.5L13 9l-.5 1.5h-1.4l1.2.9zm-8 12l1.2-.9l1.2.9l-.5-1.5l1.2-1H5.5L5 21l-.5 1.5h-1c0 .1-.1.2-.1.3l.8.6z"/>
                                            </svg>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 me-1 fs-14 fw-semibold text-dark">8,567</h6>
                                                </div>
                                                <small class="text-muted fw-semibold">United states</small>
                                            </div>
                                            <div class="user-progress">
                                                <p class="text-primary mb-0 d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-arrow-up text-success align-middle fs-16"></i>
                                                    40.8%
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3 d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 64">
                                                <path fill="#2a5f9e" d="M32 2v10H12v20H2c0 16.6 13.4 30 30 30s30-13.4 30-30S48.6 2 32 2"/><path fill="#fff" d="M32 2c-4.7 0-9.1 1.1-13.1 3v6H11v7.9H5c-1.9 4-3 8.4-3 13.1h12V17l12 15h6v-7.5L23.6 14H32z"/><g fill="#ed4c5c"><path d="M15.4 14L30 32h2v-4.9L21.4 14z"/><path d="M32 5H18.9c-6 2.9-11 7.9-13.9 13.9V32h6V11h21z"/></g><path fill="#fff" d="m8 35.7l2.2-2.7l-.7 3.5l3.5.1l-3.1 1.6L12 41l-3.1-1.4L8 43l-.9-3.4L4 41l2.1-2.8L3 36.6l3.5-.1l-.7-3.5zm44-15.5l1.8-2.2l-.6 2.8l2.8.1l-2.5 1.3l1.7 2.2l-2.5-1.2L52 26l-.7-2.8l-2.5 1.2l1.7-2.2l-2.5-1.3l2.8-.1l-.6-2.8zm0 20l1.8-2.2l-.6 2.8l2.8.1l-2.5 1.3l1.7 2.2l-2.5-1.2L52 46l-.7-2.8l-2.5 1.2l1.7-2.2l-2.5-1.3l2.8-.1l-.6-2.8zm-10-14l1.8-2.2l-.6 2.8l2.8.1l-2.5 1.3l1.7 2.2l-2.5-1.2L42 32l-.7-2.8l-2.5 1.2l1.7-2.2l-2.5-1.3l2.8-.1l-.6-2.8z"/>
                                            </svg>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 me-1 fs-14 fw-semibold text-dark">3,978</h6>
                                                </div>
                                                <small class="text-muted fw-semibold">Australia</small>
                                            </div>
                                            <div class="user-progress">
                                                <p class="text-danger mb-0 d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-arrow-down text-danger align-middle fs-16"></i>
                                                    35.8%
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3 d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 64">
                                                <path fill="#f2b200" d="M31.8 2c-13 0-24.1 8.4-28.2 20h56.6C56 10.4 44.9 2 31.8 2"/><path fill="#83bf4f" d="M31.8 62c13.1 0 24.2-8.3 28.3-20H3.6c4.1 11.7 15.2 20 28.2 20"/><path fill="#fff" d="M3.6 22c-1.1 3.1-1.7 6.5-1.7 10s.6 6.9 1.7 10h56.6c1.1-3.1 1.7-6.5 1.7-10s-.6-6.9-1.7-10z"/><circle cx="31.8" cy="32" r="8" fill="#428bc1"/><circle cx="31.8" cy="32" r="7" fill="#fff"/><g fill="#428bc1"><circle cx="29.2" cy="25.5" r=".5"/><circle cx="27.6" cy="26.4" r=".5"/><circle cx="26.3" cy="27.7" r=".5"/><circle cx="25.4" cy="29.3" r=".5"/><circle cx="24.9" cy="31.1" r=".5"/><circle cx="24.9" cy="32.9" r=".5"/><circle cx="25.4" cy="34.7" r=".5"/><circle cx="26.3" cy="36.3" r=".5"/><circle cx="27.6" cy="37.6" r=".5"/><circle cx="29.2" cy="38.5" r=".5"/><circle cx="30.9" cy="38.9" r=".5"/><path d="M32.3 39c0-.3.2-.5.4-.6c.3 0 .5.2.6.4c0 .3-.2.5-.4.6c-.4.1-.6-.1-.6-.4"/><circle cx="34.5" cy="38.5" r=".5"/><circle cx="36.1" cy="37.6" r=".5"/><circle cx="37.4" cy="36.3" r=".5"/><circle cx="38.3" cy="34.7" r=".5"/><circle cx="38.8" cy="32.9" r=".5"/><path d="M38.8 31.6c-.3 0-.5-.2-.6-.4c0-.3.2-.5.4-.6c.3 0 .5.2.6.4c.1.3-.1.5-.4.6"/><circle cx="38.3" cy="29.3" r=".5"/><circle cx="37.4" cy="27.7" r=".5"/><circle cx="36.1" cy="26.4" r=".5"/><path d="M35 25.7c-.1.3-.4.4-.7.3c-.3-.1-.4-.4-.3-.7c.1-.3.4-.4.7-.3c.3.2.4.5.3.7m-1.8-.6c0 .3-.3.5-.6.4c-.3 0-.5-.3-.4-.6c0-.3.3-.5.6-.4c.3.1.5.4.4.6m-1.8-.1c0 .3-.2.5-.4.6c-.3 0-.5-.2-.6-.4c0-.3.2-.5.4-.6c.3-.1.6.1.6.4"/><circle cx="31.8" cy="32" r="1.5"/><path d="m31.8 25l-.2 4.3l.2 2.7l.3-2.7zm-1.8.2l.9 4.3l.9 2.5l-.4-2.7z"/><path d="m28.3 25.9l2 3.9l1.5 2.2l-1.1-2.5zM26.9 27l2.9 3.3l2 1.7l-1.7-2.1z"/><path d="m25.8 28.5l3.6 2.4l2.4 1.1l-2.2-1.6z"/><path d="m25.1 30.2l4.1 1.3l2.6.5l-2.5-.9zm-.3 1.8l4.4.2l2.6-.2l-2.6-.2z"/><path d="m25.1 33.8l4.2-.9l2.5-.9l-2.6.5zm.7 1.7l3.8-1.9l2.2-1.6l-2.4 1.1z"/><path d="m26.9 36.9l3.2-2.8l1.7-2.1l-2 1.7zm1.4 1.2l2.4-3.7l1.1-2.4l-1.5 2.2z"/><path d="m30 38.8l1.4-4.1l.4-2.7l-.9 2.5zm1.8.2l.3-4.3l-.3-2.7l-.2 2.7zm1.8-.2l-.8-4.3l-1-2.5l.5 2.7z"/><path d="m35.3 38.1l-1.9-3.9l-1.6-2.2l1.2 2.5zm1.5-1.2l-2.9-3.2l-2.1-1.7l1.8 2.1z"/><path d="m37.9 35.5l-3.6-2.4l-2.5-1.1l2.2 1.6zm.7-1.7l-4.1-1.3l-2.7-.5l2.6.9zm.2-1.8l-4.3-.3l-2.7.3l2.7.2zm-.2-1.8l-4.2.9l-2.6.9l2.7-.5z"/><path d="M37.9 28.5L34 30.4L31.8 32l2.5-1.1zm-1.1-1.4l-3.2 2.8l-1.8 2.1l2.1-1.7z"/><path d="M35.3 25.9L33 29.6L31.8 32l1.6-2.2z"/><path d="m33.7 25.2l-1.4 4.1l-.5 2.7l1-2.5z"/></g>
                                            </svg>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 me-1 fs-14 fw-semibold text-dark">9,874</h6>
                                                </div>
                                                <small class="text-muted fw-semibold">India</small>
                                            </div>
                                            <div class="user-progress">
                                                <p class="text-primary mb-0 d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-arrow-up text-success align-middle fs-16"></i>
                                                    55.8%
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3 d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 64"><path fill="#f9f9f9" d="M48 6.6C43.4 3.7 37.9 2 32 2S20.6 3.7 16 6.6v50.7c4.6 2.9 10.1 4.6 16 4.6s11.4-1.7 16-4.6z"/><path fill="#ed4c5c" d="M48 6.6v50.7c8.4-5.2 14-14.8 14-25.4s-5.6-20-14-25.3m-32 0C7.6 11.9 2 21.5 2 32s5.6 20.1 14 25.4zm26.9 25c-.4-.2-.5-.6-.4-.8l1-3.6l-3.5.7c-.1 0-.5 0-.6-.7l-.3-1.2l-2.4 2.8s-1.6 1.7-1.1-.9l1-5.5l-1.9 1c-.1 0-.5.1-1-.9L32 19l-1.8 3.3c-.5 1-.9.9-1 .9l-1.9-1l1 5.5c.5 2.6-1.1.9-1.1.9l-2.4-2.8l-.3 1.2c-.2.7-.5.7-.6.7l-3.5-.7l1 3.6c0 .3 0 .6-.4.8l-1 .6s4 3.2 5.3 4.3c.3.2.9.8.7 1.5l-.5 1.4l5.5-.8c.3 0 .9 0 .8.9l-.3 5.7h1l-.3-5.7c0-.9.6-.9.8-.9l5.5.8l-.5-1.4c-.2-.7.4-1.3.7-1.5C40 35.2 44 32 44 32z"/></svg>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 me-1 fs-14 fw-semibold text-dark">7,897</h6>
                                                </div>
                                                <small class="text-muted fw-semibold">Canada</small>
                                            </div>
                                            <div class="user-progress">
                                                <p class="text-danger mb-0 d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-arrow-down text-danger align-middle fs-16"></i>
                                                    30.0%
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3 d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 64">
                                                <path fill="#2a5f9e" d="M32 2v10H12v20H2c0 16.6 13.4 30 30 30s30-13.4 30-30S48.6 2 32 2"/><g fill="#fff"><path d="M14 8C6.7 13.5 2 22.2 2 32h12z"/><path d="M8 14h24V2C22.2 2 13.5 6.7 8 14"/><path d="M9.8 11.8L26 32h6v-7.5L17.1 5.9c-2.7 1.6-5.2 3.6-7.3 5.9"/></g><g fill="#ed4c5c"><path d="M32 5H18.9c-6 2.9-11 7.9-13.9 13.9V32h6V11h21z"/><path d="M32 27.1L19 11h-6l17 21h2z"/></g><path fill="#fff" d="m37.1 32l1-2.9l-2.7-1.9h3.4l1-2.8l1 2.8h3.4l-2.7 1.9l1 2.9l-2.7-1.8z"/><path fill="#ed4c5c" d="m39.8 29.5l1.6 1.1l-.6-1.8l1.6-1.1h-2l-.6-1.7l-.6 1.7h-2l1.6 1.1l-.6 1.8z"/><path fill="#fff" d="m54.6 32l1-2.9l-2.7-1.9h3.4l1-2.8l1 2.8h3.4L59 29.1l1 2.9l-2.7-1.8z"/><path fill="#ed4c5c" d="m57.3 29.5l1.6 1.1l-.6-1.8l1.6-1.1h-2l-.6-1.7l-.6 1.7h-2l1.6 1.1l-.6 1.8z"/><path fill="#fff" d="m45.9 21.7l1-2.9l-2.7-1.9h3.4l1-2.8l1 2.8H53l-2.7 1.9l1 2.9l-2.7-1.8z"/><path fill="#ed4c5c" d="m48.5 19.2l1.6 1.1l-.6-1.8l1.6-1.1h-1.9l-.7-1.7l-.5 1.7h-2l1.6 1.1l-.6 1.8z"/><path fill="#fff" d="m45 48.7l1.3-3.8l-3.6-2.5h4.5l1.3-3.7l1.3 3.7h4.4l-3.6 2.5l1.3 3.8l-3.5-2.4z"/><path fill="#ed4c5c" d="m48.5 45.4l2.1 1.4l-.7-2.3l2-1.5h-2.5l-.9-2.2l-.7 2.2h-2.6l2 1.5l-.7 2.3z"/><path fill="#fff" d="M12.6 11h12.2v3H12.6z"/>
                                            </svg>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 me-1 fs-14 fw-semibold text-dark">6,487</h6>
                                                </div>
                                                <small class="text-muted fw-semibold">New Zealand</small>
                                            </div>
                                            <div class="user-progress">
                                                <p class="text-primary mb-0 d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-arrow-up text-success align-middle fs-16"></i>
                                                    68.8%
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3 d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 64">
                                                <path fill="#2a5f9e" d="M32 2v10H12v20H2c0 16.6 13.4 30 30 30s30-13.4 30-30S48.6 2 32 2"/><g fill="#fff"><path d="M14 8C6.7 13.5 2 22.2 2 32h12z"/><path d="M8 14h24V2C22.2 2 13.5 6.7 8 14"/><path d="M9.8 11.8L26 32h6v-7.5L17.1 5.9c-2.7 1.6-5.2 3.6-7.3 5.9"/></g><g fill="#ed4c5c"><path d="M32 5H18.9c-6 2.9-11 7.9-13.9 13.9V32h6V11h21z"/><path d="M32 27.1L19 11h-6l17 21h2z"/></g><path fill="#fff" d="m37.1 32l1-2.9l-2.7-1.9h3.4l1-2.8l1 2.8h3.4l-2.7 1.9l1 2.9l-2.7-1.8z"/><path fill="#ed4c5c" d="m39.8 29.5l1.6 1.1l-.6-1.8l1.6-1.1h-2l-.6-1.7l-.6 1.7h-2l1.6 1.1l-.6 1.8z"/><path fill="#fff" d="m54.6 32l1-2.9l-2.7-1.9h3.4l1-2.8l1 2.8h3.4L59 29.1l1 2.9l-2.7-1.8z"/><path fill="#ed4c5c" d="m57.3 29.5l1.6 1.1l-.6-1.8l1.6-1.1h-2l-.6-1.7l-.6 1.7h-2l1.6 1.1l-.6 1.8z"/><path fill="#fff" d="m45.9 21.7l1-2.9l-2.7-1.9h3.4l1-2.8l1 2.8H53l-2.7 1.9l1 2.9l-2.7-1.8z"/><path fill="#ed4c5c" d="m48.5 19.2l1.6 1.1l-.6-1.8l1.6-1.1h-1.9l-.7-1.7l-.5 1.7h-2l1.6 1.1l-.6 1.8z"/><path fill="#fff" d="m45 48.7l1.3-3.8l-3.6-2.5h4.5l1.3-3.7l1.3 3.7h4.4l-3.6 2.5l1.3 3.8l-3.5-2.4z"/><path fill="#ed4c5c" d="m48.5 45.4l2.1 1.4l-.7-2.3l2-1.5h-2.5l-.9-2.2l-.7 2.2h-2.6l2 1.5l-.7 2.3z"/><path fill="#fff" d="M12.6 11h12.2v3H12.6z"/>
                                            </svg>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 me-1 fs-14 fw-semibold text-dark">3,648</h6>
                                                </div>
                                                <small class="text-muted fw-semibold">New Zealand</small>
                                            </div>
                                            <div class="user-progress">
                                                <p class="text-primary mb-0 d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-arrow-up text-success align-middle fs-16"></i>
                                                    68.8%
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center mb-0">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3 d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 64">
                                                <path fill="#428bc1" d="M1.9 32c0 13.1 8.4 24.2 20 28.3V3.7C10.3 7.8 1.9 18.9 1.9 32"/>
                                                <path fill="#ed4c5c" d="M61.9 32c0-13.1-8.3-24.2-20-28.3v56.6c11.7-4.1 20-15.2 20-28.3"/>
                                                <path fill="#fff" d="M21.9 60.3c3.1 1.1 6.5 1.7 10 1.7s6.9-.6 10-1.7V3.7C38.8 2.6 35.5 2 31.9 2s-6.9.6-10 1.7z"/>
                                            </svg>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 me-1 fs-14 fw-semibold text-dark">2,578</h6>
                                                </div>
                                                <small class="text-muted fw-semibold">France</small>
                                            </div>
                                            <div class="user-progress">
                                                <p class="text-primary mb-0 d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-arrow-up text-success align-middle fs-16"></i>
                                                    68.8%
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Start Visit By Source -->
                    <div class="col-md-12 col-xl-4">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0">Visits by Source</h5>
                                    <div class="ms-auto"> 
                                        <button class="btn btn-sm bg-light border dropdown-toggle fw-medium" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View All<i class="mdi mdi-chevron-down ms-1 fs-14"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">New Tickets</a>
                                            <a class="dropdown-item" href="#">New Customer</a>
                                            <a class="dropdown-item" href="#">New Contact</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush list-group-no-gutters">
                                    <!-- List Item -->
                                    <li class="list-group-item px-0 pt-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <!-- Avatar -->
                                                <div class="align-content-center text-center rounded-3">
                                                    <span class="avatar rounded-3 avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"><path fill="#6c757d" d="m3.7 11.287l3.623-3.624q.293-.292.671-.413t.783-.04l1.415.294Q9.073 8.873 8.366 9.98t-1.414 2.688zm4.125 1.62q.652-1.51 1.563-2.89q.91-1.378 2.08-2.548q1.873-1.873 4.073-2.806t4.746-.797q.136 2.546-.795 4.746t-2.803 4.073q-1.164 1.163-2.548 2.07t-2.897 1.559zm6.17-2.768q.44.44 1.066.44t1.066-.44t.44-1.057t-.44-1.057t-1.066-.44t-1.067.44t-.44 1.057t.44 1.056m-1.161 10.314L11.444 17.2q1.581-.706 2.691-1.423q1.111-.717 2.48-1.836l.289 1.415q.08.404-.031.785q-.111.382-.404.675zm-7.687-4.306q.587-.586 1.423-.58t1.423.594q.587.586.587 1.423t-.587 1.423q-.51.51-1.635.873t-2.605.502q.138-1.479.511-2.602t.883-1.633"/></svg>
                                                    </span>
                                                </div>
                                                <!-- End Avatar -->
                                            </div>
                                            <div class="align-content-center">
                                                <h6 class="mb-0 text-dark fs-14">Direct Marketing</h6>
                                            </div>
                                            <div class="ms-auto align-content-center">
                                                <span class="text-dark fw-medium fs-14 me-3">2,067</span>
                                                <span class="badge bg-success-subtle text-success fs-12 p-1"><i class="mdi mdi-arrow-up text-success align-middle fs-14"></i> 2.6%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End List Item -->
                                    <!-- List Item -->
                                    <li class="list-group-item px-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <!-- Avatar -->
                                                <div class="align-content-center text-center rounded-3">
                                                    <span class="avatar rounded-3 avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#6c757d" d="M13.75 2a.75.75 0 0 0-1.5 0v12.536A4.75 4.75 0 1 0 13.75 18V6.243A6.74 6.74 0 0 0 19 8.75a.75.75 0 0 0 0-1.5A5.25 5.25 0 0 1 13.75 2"/></svg>
                                                    </span>
                                                </div>
                                                <!-- End Avatar -->
                                            </div>
                                            <div class="align-content-center">
                                                <h6 class="mb-0 text-dark fs-14">Social Media Marketing</h6>
                                            </div>
                                            <div class="ms-auto align-content-center">
                                                <span class="text-dark fw-medium fs-14 me-3">7,895</span>
                                                <span class="badge bg-success-subtle text-success fs-12 p-1"><i class="mdi mdi-arrow-up text-success align-middle fs-14"></i> 4.8%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End List Item -->
                                    <!-- List Item -->
                                    <li class="list-group-item px-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <!-- Avatar -->
                                                <div class="align-content-center text-center rounded-3">
                                                    <span class="avatar rounded-3 avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#6c757d" fill-rule="evenodd" d="M3.172 5.172C2 6.343 2 8.229 2 12s0 5.657 1.172 6.828S6.229 20 10 20h4c3.771 0 5.657 0 6.828-1.172S22 15.771 22 12s0-5.657-1.172-6.828S17.771 4 14 4h-4C6.229 4 4.343 4 3.172 5.172M18.576 7.52a.75.75 0 0 1-.096 1.056l-2.196 1.83c-.887.74-1.605 1.338-2.24 1.746c-.66.425-1.303.693-2.044.693s-1.384-.269-2.045-.693c-.634-.408-1.352-1.007-2.239-1.745L5.52 8.577a.75.75 0 0 1 .96-1.153l2.16 1.799c.933.777 1.58 1.315 2.128 1.667c.529.34.888.455 1.233.455s.704-.114 1.233-.455c.547-.352 1.195-.89 2.128-1.667l2.159-1.8a.75.75 0 0 1 1.056.097" clip-rule="evenodd"/></svg>
                                                    </span>
                                                </div>
                                                <!-- End Avatar -->
                                            </div>
                                            <div class="align-content-center">
                                                <h6 class="mb-0 text-dark fs-14">Email Marketing</h6>
                                            </div>
                                            <div class="ms-auto align-content-center">
                                                <span class="text-dark fw-medium fs-14 me-3">45,150</span>
                                                <span class="badge bg-success-subtle text-success fs-12 p-1"><i class="mdi mdi-arrow-up text-success align-middle fs-14"></i> 6.5%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End List Item -->
                                    <!-- List Item -->
                                    <li class="list-group-item px-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <!-- Avatar -->
                                                <div class="align-content-center text-center rounded-3">
                                                    <span class="avatar rounded-3 avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#6c757d" d="M21.775 14.118Q22 13.092 22 12a10 10 0 0 0-.525-3.206l-.527-.038h-.011l-.051-.003a10 10 0 0 0-1.096.043a13.4 13.4 0 0 0-3.047.67c-.263.09-.563.252-.958.485l-.248.148c-.322.192-.69.413-1.088.62c-1.03.539-2.323 1.031-4.012 1.031c-2.418 0-4.407-.804-5.78-1.596a12.4 12.4 0 0 1-1.6-1.096a9 9 0 0 1-.48-.415a10.1 10.1 0 0 0-.498 4.628l.385-.02h.011l.027-.001a9 9 0 0 1 .45-.006c.303.002.733.014 1.253.054c1.037.082 2.447.278 3.923.742c.45.142.899.374 1.327.606l.299.163c.346.19.697.383 1.087.57c.98.47 2.144.871 3.668.871c1.383 0 2.662-.344 3.802-.766c.571-.21 1.099-.438 1.591-.65l.018-.007c.475-.204.937-.403 1.343-.538z"/><path fill="#6c757d" d="M21.206 15.912q-.32.131-.711.3l-.01.005c-.487.21-1.045.45-1.654.674c-1.226.454-2.693.86-4.322.86c-1.813 0-3.203-.486-4.317-1.02a24 24 0 0 1-1.18-.617l-.272-.15c-.43-.232-.764-.399-1.062-.493a16.4 16.4 0 0 0-3.59-.677a16 16 0 0 0-1.453-.048l-.077.003h-.02l-.153.008C3.582 18.94 7.433 22 12 22c4.135 0 7.683-2.51 9.206-6.088M2.71 8.293l.285-.28zm.527-1.114l.297.302l.003.004l.019.018l.086.081c.079.072.2.18.36.31c.32.26.795.61 1.404.96c1.219.704 2.95 1.396 5.031 1.396c1.374 0 2.425-.394 3.317-.86c.355-.186.675-.377.993-.567l.275-.163c.392-.232.81-.468 1.235-.614a15 15 0 0 1 3.39-.743a11 11 0 0 1 1.156-.052A10 10 0 0 0 12 2a10 10 0 0 0-8.763 5.179m17.786.504L21 8.006z"/></svg>
                                                    </span>
                                                </div>
                                                <!-- End Avatar -->
                                            </div>
                                            <div class="align-content-center">
                                                <h6 class="mb-0 text-dark fs-14">Referrals</h6>
                                            </div>
                                            <div class="ms-auto align-content-center">
                                                <span class="text-dark fw-medium fs-14 me-3">1,478</span>
                                                <span class="badge bg-danger-subtle text-danger fs-12 p-1"><i class="mdi mdi-arrow-down text-danger align-middle fs-14"></i> 0.8%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End List Item -->
                                    <!-- List Item -->
                                    <li class="list-group-item px-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <!-- Avatar -->
                                                <div class="align-content-center text-center rounded-3">
                                                    <span class="avatar rounded-3 avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#6c757d" d="m17.498 18.485l3.13-9.391c.791-2.373 1.331-3.994 1.37-5.115c.013-.377-.414-.503-.68-.236l-14.46 14.46c-.233.233-.177.626.14.716q.047.013.095.024c.5.123 1.153.034 2.46-.143l.07-.01c.369-.05.553-.075.73-.064c.32.02.63.124.898.303c.147.098.279.23.541.492l.252.252c1.51 1.51 2.265 2.265 3.066 2.226c.22-.011.438-.062.64-.151c.734-.324 1.072-1.337 1.747-3.363M14.906 3.372l-9.331 3.11c-2.082.694-3.123 1.041-3.439 1.804q-.112.271-.133.564c-.059.824.717 1.6 2.269 3.151l.283.283c.254.255.382.382.478.524c.19.28.297.606.31.944c.008.171-.019.35-.072.705c-.196 1.304-.294 1.956-.179 2.458l.013.052c.081.325.48.387.717.15L20.257 2.683c.267-.267.141-.694-.236-.68c-1.121.038-2.742.578-5.115 1.369"/></svg>
                                                    </span>
                                                </div>
                                                <!-- End Avatar -->
                                            </div>
                                            <div class="align-content-center">
                                                <h6 class="mb-0 text-dark fs-14">Digital Marketing</h6>
                                            </div>
                                            <div class="ms-auto align-content-center">
                                                <span class="text-dark fw-medium fs-14 me-3">25,058</span>
                                                <span class="badge bg-success-subtle text-success fs-12 p-1"><i class="mdi mdi-arrow-up text-success align-middle fs-14"></i> 2.02%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End List Item -->
                                    <!-- List Item -->
                                    <li class="list-group-item px-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <!-- Avatar -->
                                                <div class="align-content-center text-center rounded-3">
                                                    <span class="avatar rounded-3 avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#6c757d" d="M19.992 11.643q.425-.38.789-.752c.754-.77 1.342-1.54 1.672-2.268c.324-.716.458-1.544.012-2.258c-.42-.67-1.185-.96-1.956-1.064c-.79-.107-1.75-.041-2.797.152l-.888.165a8 8 0 0 0-12.82 6.641l-.527.593c-.84.817-1.497 1.636-1.872 2.403c-.366.75-.54 1.627-.07 2.38c.433.691 1.232.979 2.032 1.074c.825.098 1.828.016 2.923-.201q.323-.064.66-.145a8 8 0 0 1-1.311-1.26c-.853.146-1.56.18-2.095.116c-.632-.075-.865-.264-.937-.38c-.063-.1-.132-.358.145-.925c.241-.494.688-1.092 1.342-1.758a8 8 0 0 0 1.545 2.947q.176-.03.36-.067c2.02-.4 4.613-1.351 7.28-2.772c2.665-1.42 4.848-3.012 6.227-4.42a8 8 0 0 0-1.545-2.947c.885-.151 1.61-.182 2.149-.11c.594.08.813.262.883.374c.06.095.126.33-.107.844c-.227.502-.683 1.129-1.377 1.836l-.003.003c.161.576.259 1.179.286 1.799"/><path fill="#6c757d" d="M12 20a8 8 0 0 0 7.992-8.357c-1.481 1.327-3.49 2.71-5.808 3.945c-2.492 1.328-4.96 2.281-7.033 2.775A7.97 7.97 0 0 0 12 20"/></svg>
                                                    </span>
                                                </div>
                                                <!-- End Avatar -->
                                            </div>
                                            <div class="align-content-center">
                                                <h6 class="mb-0 text-dark fs-14">Networing Marketing</h6>
                                            </div>
                                            <div class="ms-auto align-content-center">
                                                <span class="text-dark fw-medium fs-14 me-3">9,985</span>
                                                <span class="badge bg-success-subtle text-success fs-12 p-1"><i class="mdi mdi-arrow-up text-success align-middle fs-14"></i> 3.08%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End List Item -->
                                    
                                    <!-- List Item -->
                                    <li class="list-group-item px-0 pb-1">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <!-- Avatar -->
                                                <div class="align-content-center text-center rounded-3">
                                                    <span class="avatar rounded-3 avatar-sm bg-light d-flex align-items-center justify-content-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#6c757d" d="M12 21c4.418 0 8-3.356 8-7.496c0-3.741-2.035-6.666-3.438-8.06c-.26-.258-.694-.144-.84.189c-.748 1.69-2.304 4.123-4.293 4.123c-1.232.165-3.112-.888-1.594-6.107c.137-.47-.365-.848-.749-.534C6.905 4.905 4 8.511 4 13.504C4 17.644 7.582 21 12 21"/></svg>
                                                    </span>
                                                </div>
                                                <!-- End Avatar -->
                                            </div>
                                            <div class="align-content-center">
                                                <h6 class="mb-0 text-dark fs-14">Other</h6>
                                            </div>
                                            <div class="ms-auto align-content-center">
                                                <span class="text-dark fw-medium fs-14 me-3">6,124</span>
                                                <span class="badge bg-success-subtle text-success fs-12 p-1"><i class="mdi mdi-arrow-up text-success align-middle fs-14"></i> 8.4%</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End List Item -->    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Monthly Sales -->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card overflow-hidden">
                            
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0">Campaign Source</h5>
                                </div>
                            </div>
                            <div class="card-body mt-0">
                                <div class="table-responsive table-card mt-0">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col" class="cursor-pointer">Source</th>
                                                <th scope="col" class="cursor-pointer">Medium</th>
                                                <th scope="col" class="cursor-pointer">Impression</th>
                                                <th scope="col" class="cursor-pointer">Campaign Name</th>
                                                <th scope="col" class="cursor-pointer">Clicks</th>
                                                <th scope="col" class="cursor-pointer">Cost</th>
                                                <th scope="col" class="cursor-pointer desc">Conversion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Google</td>
                                                <td class="text-muted">CPC</td>
                                                <td class="text-muted">3,432,18</td>
                                                <td class="text-muted">Summer Sale 2024</td>
                                                <td class="text-muted">4,819,21</td>
                                                <td class="text-muted">$2,876,23</td>
                                                <td>3,218,49</td>
                                            </tr>
                                            <tr>
                                                <td>Facebook</td>
                                                <td class="text-muted">Social</td>
                                                <td class="text-muted">4,432,18</td>
                                                <td class="text-muted">Holiday Promo</td>
                                                <td class="text-muted">1,224,56</td>
                                                <td class="text-muted">$4,983,40</td>
                                                <td>5,152,60</td>
                                            </tr>
                                            <tr>
                                                <td>Instagram</td>
                                                <td class="text-muted">Social</td>
                                                <td class="text-muted">6,159,32</td>
                                                <td class="text-muted">New Product Launch</td>
                                                <td class="text-muted">8,951,34</td>
                                                <td class="text-muted">$7,436,54</td>
                                                <td>4,254,41</td>
                                            </tr>
                                            <tr>
                                                <td>Twitter</td>
                                                <td class="text-muted">Social</td>
                                                <td class="text-muted">21,154,34</td>
                                                <td class="text-muted">Flash Sale</td>
                                                <td class="text-muted">12,018,30</td>
                                                <td class="text-muted">$12,543,01</td>
                                                <td>43,309,28</td>
                                            </tr>
                                            <tr>
                                                <td>Affiliate</td>
                                                <td class="text-muted">Affiliate</td>
                                                <td class="text-muted">34,154,31</td>
                                                <td class="text-muted">Partner Campaign</td>
                                                <td class="text-muted">11,018,30</td>
                                                <td class="text-muted">$18,650,58</td>
                                                <td>89,309,28</td>
                                            </tr>
                                            <tr>
                                                <td>YouTube</td>
                                                <td class="text-muted">Video</td>
                                                <td class="text-muted">14,154,31</td>
                                                <td class="text-muted">Partner Campaign</td>
                                                <td class="text-muted">18,018,30</td>
                                                <td class="text-muted">$47,650,58</td>
                                                <td>54,309,28</td>
                                            </tr>
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0">Top Session</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="top-session" class="apex-charts"></div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-center p-1">
                                            <div>
                                                <i class="mdi mdi-circle fs-12 align-middle me-1 text-success"></i>
                                                <span class="align-middle fw-semibold">Chrome</span>
                                            </div>
                                            <span class="fw-medium text-muted float-end"><i class="mdi mdi-arrow-up text-success align-middle fs-14 me-1"></i>12.48%</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-1">
                                            <div>
                                                <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #522c8f;"></i>
                                                <span class="align-middle fw-semibold">Firefox</span>
                                            </div>
                                            <span class="fw-medium text-muted float-end"><i class="mdi mdi-arrow-up text-success align-middle fs-14 me-1"></i>5.23%</span>
                                        </div>
                                        
                                    </div>
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-center p-1">
                                            <div>
                                                <i class="mdi mdi-circle fs-12 align-middle me-1 text-warning"></i>
                                                <span class="align-middle fw-semibold"> Safari</span>
                                            </div>
                                            <span class="fw-medium text-muted float-end"><i class="mdi mdi-arrow-up text-success align-middle fs-14 me-1"></i>15.58%</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-1">
                                            <div>
                                                <i class="mdi mdi-circle fs-12 align-middle me-1" style="color: #01D4FF"></i>
                                                <span class="align-middle fw-semibold"> Opera</span>
                                            </div>
                                            <span class="fw-medium text-muted float-end"><i class="mdi mdi-arrow-up text-success align-middle fs-14 me-1"></i>14.15%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0">Top Leads</h5>
                                    <div class="ms-auto"> 
                                        <button class="btn btn-sm bg-light border dropdown-toggle fw-medium" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort by Created<i class="mdi mdi-chevron-down ms-1 fs-14"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Created</a>
                                            <a class="dropdown-item" href="#">Converted</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="totalleads" class="apex-charts mt-n3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0">Top Performing Pages</h5>
                                </div>
                            </div>
                            <div class="card-body mt-0">
                                <div class="table-responsive table-card mt-0">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th class="width-xxl cursor-pointer" colspan="2">Pages</th>
                                                <th class="width-sm cursor-pointer text-end pe-0" colspan="2">Click</th>
                                                <th class="cursor-pointer width-sm text-end" colspan="2">Avg.position</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">Index</td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">1,101</span>
                                                        <span class="text-danger d-block text-end fs-14">-435</span>
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">3.58</span>
                                                        <span class="text-danger d-block text-end fs-14">-2.45</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="2">Blog</td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">657</span>
                                                        <span class="text-danger d-block text-end fs-14">-535</span>
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">2.35</span>
                                                        <span class="text-danger d-block text-end fs-14">-1.05</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Products</td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">745</span>
                                                        <span class="text-success d-block text-end fs-14">935</span>
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">3.58</span>
                                                        <span class="text-success d-block text-end fs-14">2.45</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Licenses</td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">1,587</span>
                                                        <span class="text-danger d-block text-end fs-14">235</span>                                                              
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">7.47</span>
                                                        <span class="text-danger d-block text-end fs-14">-3.89</span>                                                 
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Affiliate</td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">1,947</span>
                                                        <span class="text-success d-block text-end fs-14">635</span>
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">4.58</span>
                                                        <span class="text-success d-block text-end fs-14">3.45</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Socials</td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">1,247</span>
                                                        <span class="text-danger d-block text-end fs-14">-735</span>
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">4.41</span>
                                                        <span class="text-danger d-block text-end fs-14">-3.21</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">zoyothemes.com</td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">847</span>
                                                        <span class="text-danger d-block text-end fs-14">-562</span>
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-end">                                
                                                        <span class="text-dark fs-14 me-3">2.57</span>
                                                        <span class="text-danger d-block text-end fs-14">-1.21</span>
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
            </div> <!-- container-fluid -->
        </div> <!-- content -->
    
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

        <!-- END wrapper -->
@endsection