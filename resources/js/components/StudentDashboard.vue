<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="callout callout-info bg-white">
                    <div class="card-body pb-0">
                        <div class="text-tile">{{activations.length}}</div>
                        <div class="tile-sub-text">Active Certifications</div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
                <div class="callout callout-success bg-white">
                    <div class="card-body pb-0">
                        <div class="text-tile">{{results.length}}</div>
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
                                <th class="text-center">Certification Name</th>
                                <th class="text-center">Topics Covered</th>
                                <th class="text-center">Time Limit</th>
                                <th class="text-center">Activation Date</th>
                            </tr>
                            </thead>
                            <tbody id="active-tests-table">
                            <tr v-if="activations.length==0"><td colspan="6">No Data</td></tr>
                            <tr v-for="activation in activations">
                                <td class="text-center">{{activation.element.certificationCode}}</td>
                                <td class="text-center">{{activation.element.certificationName}}</td>
                                <td class="text-center"><div v-for="topic in activation.topics">
                                    <b>{{topic.code+': '+topic.name}}</b><br>{{topic.list}}
                                </div></td>
                                <td class="text-center">{{activation.element.totalTime + ' Min'}}</td>
                                <td class="text-center">{{activation.element.activationDate}}</td>
                            </tr>
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
        <!-- /.row-->
    </div>
</template>

<script>
    export default {
        name: "StudentDashboard",
        data(){
            return{
                pendingTests:0,
                failedTests:0,
                activations:[],
                results:[],
            }
        },
        methods:{
          fetchActive()
          {
              this.$data.activations=[];
              axios({
                  method:'get',
                  url:'/api/fetch/allActive'
              }).then(response=>{
                  response.data.forEach((element,index)=>{
                      axios({
                          method:'get',
                          url:'/api/fetch/certification/'+element.activationID+'/subjects/topics/'
                      }).then(res=>{
                          this.$data.activations.push({
                              element,topics:res.data
                          })
                      })
                  })
              });
          },fetchResults()
          {
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
        },
        mounted() {
            this.fetchActive();
            this.fetchResults();
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
