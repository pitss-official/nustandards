<template>
    <div class="animated fadeIn">
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
    </div>
</template>

<script>
    export default {
        name: "PassedTests"
    }
</script>

<style scoped>

</style>
