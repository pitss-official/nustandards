<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="callout callout-info bg-white">
                    <div class="card-body pb-0">
                        <div class="text-tile">{{activeTests}}</div>
                        <div class="tile-sub-text">Active Certifications</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="callout callout-success bg-white">
                    <div class="card-body pb-0">
                        <div class="text-tile">{{passedTests}}</div>
                        <div class="tile-sub-text">Passed Certifications</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="callout callout-warning bg-white">
                    <div class="card-body pb-0">
                        <div class="text-tile">{{pendingTests}}</div>
                        <div class="tile-sub-text">Pending Activations</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="callout callout-danger bg-white">
                    <div class="card-body pb-0">
                        <div class="text-tile">{{failedTests}}</div>
                        <div class="tile-sub-text">Failed Certifications</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Active Tests</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-hover table-outline mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center">Certification ID</th>
                                <th>Certification Name</th>
                                <th>Topics Covered</th>
                                <th class="text-center">Activation Date</th>
                                <th>Link</th>
                            </tr>
                            </thead>
                            <tbody id="active-tests-table">
                            <tr><td colspan="6">No Data</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My Results</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-hover table-outline mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center">Test ID</th>
                                <th>Certification Name</th>
                                <th class="text-center">Attended Date</th>
                                <th>Topics Covered</th>
                                <th class="text-center">Results</th>
                                <th>Certificate Link</th>
                            </tr>
                            </thead>
                            <tbody id="results-table">
                            <tr><td colspan="6">No Data</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row-->
    </div>
</template>

<script>
    export default {
        name: "StudentDashboard",
        data(){
            return{
                activeTests:0,
                passedTests:0,
                pendingTests:0,
                failedTests:0,
            }
        }
    }
</script>

<style scoped>
    .text-tile{
        font-size: 3rem;
    }
    .tile-sub-text
    {
        padding-bottom: 20px;
    }
</style>
