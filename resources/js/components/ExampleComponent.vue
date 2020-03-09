<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">勤怠状況</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">日</th>
                                <th scope="col">出勤</th>
                                <th scope="col">退勤</th>
                                <th scope="col">休憩計</th>
                                <th scope="col">合計稼働時間</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="work_time in work_time_list">
                                <td>{{ work_time.day }}({{work_time.week_day}})</td>
                                <td>{{ work_time.work_start_time }}</td>
                                <td>{{ work_time.work_end_time }}</td>
                                <td>{{ work_time.sum_break_time }}</td>
                                <td>{{ work_time.day_work_time }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                work_time_list: []
            }
        },
        mounted() {
            console.log(this.props);
            axios.get('/api/report/day_summary?api_token=' + $('meta[name="api_token"]').attr('content')).then(res => this.work_time_list = res.data)
        }
    }
</script>
