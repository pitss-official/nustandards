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
                                <th class="text-center">Certification Name</th>
                                <th class="text-center">Attended Date</th>
                                <th class="text-center">Topics Covered</th>
                                <th class="text-center">Results</th>
                                <th class="text-center">Valid Till</th>
                                <th class="text-center">Certificate Link</th>
                            </tr>
                            </thead>
                            <tbody id="results-table">
                            <tr v-if="results.length==0"><td colspan="7">No Data</td></tr>
                            <tr v-for="result in results">
                                <td class="text-center">{{result.element.activationID}}</td>
                                <td class="text-center">{{result.element.certificationName}}</td>
                                <td class="text-center">{{result.element.attendedDate}}</td>
                                <td class="text-center"><div v-for="topic in result.topics">
                                    <b>{{topic.code+': '+topic.name}}</b><br>{{topic.list}}
                                </div></td>
                                <td class="text-center" v-if="result.element.grade!=null">{{result.element.grade}}</td>
                                <td class="text-center" v-else>Pending</td>
                                <td class="text-center" v-if="result.element.validity!=null">{{result.element.validity}}</td>
                                <td class="text-center" v-else>Inactive</td>
                                <td class="text-center"><a v-if="result.element.link!=null" :href="result.element.link">Certificate</a><div v-else>Pending</div></td>
                            </tr>
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
        name: "PassedTests",
        data(){
            return{
                results:[],
            }
        },
        methods:
            {
                opentest(activationID)
                {
                    var opn=window.open("/attemptTest/"+activationID,"_blank", "toolbar=no,scrollbars=yes,resizable=no,fullscreen=yes,channelmode=yes,directories=no,menubar=no,status=no,titlebar=no");
                    opn.opener.document.write("<p>You engaged your session by starting an examination</p>");
                }
            },
        mounted() {
            this.$data.results=[];
            axios({
                method:'get',
                url:'/api/fetch/allPassed'
            }).then(response=>{
                response.data.forEach((element,index)=>{
                    axios({
                        method:'get',
                        url:'/api/fetch/certification/'+element.activationID+'/subjects/topics/'
                    }).then(res=>{
                        this.$data.results.push({
                            element,topics:res.data
                        })
                    })
                })
            });
        }
    }
</script>

<style scoped>

</style>
