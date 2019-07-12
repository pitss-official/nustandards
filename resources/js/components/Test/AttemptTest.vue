<template>
    <div class="animated fadeIn">
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
    </div>
</template>

<script>
    export default {
        name: "AttemptTest"
    }
</script>

<style scoped>

</style>
