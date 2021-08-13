<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input v-model="listQuery.title" placeholder="Search Name" style="width: 200px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-select v-model="listQuery.status" placeholder="Status" clearable style="min-width: 150px" class="filter-item">
        <el-option v-for="item in statusOptions" :key="item" :label="item" :value="item" />
      </el-select>
      <el-select v-model="listQuery.sort" style="min-width: 150px" class="filter-item" @change="handleFilter">
        <el-option v-for="item in sortOptions" :key="item.key" :label="item.label" :value="item.key" />
      </el-select>
      <el-button v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
        {{ $t('table.search') }}
      </el-button>
    </div>
    <!-- membership table -->
    <el-table
      :key="tableKey"
      v-loading="listLoading"
      :data="list"
      border
      fit
      highlight-current-row
      style="width: 100%;"
      @sort-change="sortChange"
    >
      <el-table-column label="ID" align="center" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>
      <el-table-column label="Application Date" prop="created_at" sortable="custom" min-width="150px" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.created_at | parseTime('{y}-{m}-{d} {h}:{i}') }}</span>
        </template>
      </el-table-column>
      <el-table-column label="Name" min-width="150px" align="center">
        <template slot-scope="scope">
          {{ scope.row.profile.first_name }} {{ scope.row.profile.last_name }}
        </template>
      </el-table-column>
      <el-table-column label="Department" min-width="150px" align="center">
        <template slot-scope="scope">
          <span>{{ scope.row.profile.department }}</span>
        </template>
      </el-table-column>
      <el-table-column label="Status" class-name="status-col" min-width="100">
        <template slot-scope="scope">
          <el-tag :type="scope.row.status | statusFilter">
            {{ scope.row.status }}
          </el-tag>
        </template>
      </el-table-column>
      <el-table-column :label="$t('table.actions')" align="center" class-name="small-padding fixed-width">
        <template slot-scope="{row}">
          <el-button v-if="row.status==='PENDING'" type="primary" size="mini" @click="review_application(row.id)">
            Review
          </el-button>
          <el-button v-if="row.status!=='PENDING'" type="success" size="mini" @click="review_application(row.id)">
            View
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <!-- pagination -->
    <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit" @pagination="getMembershipData" />

  </div>
</template>

<script>
import waves from '@/directive/waves'; // Waves directive
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
const membershipResource = new Resource('membership');

export default {
  name: 'MembershipList',
  components: { Pagination },
  directives: { waves },
  filters: {
    statusFilter(status) {
      const statusMap = {
        PENDING: 'success',
        APPROVED: 'primary',
        REJECTED: 'danger',
      };
      return statusMap[status];
    },
  },
  data() {
    return {
      tableKey: 0,
      list: null,
      total: 0,
      listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
        importance: undefined,
        title: undefined,
        type: undefined,
        sort: '+created_at',
      },
      sortOptions: [{ label: 'Newest Applications First', key: '+created_at' }, { label: 'Oldest Applications First', key: '-created_at' }],
      statusOptions: ['PENDING', 'APPROVED', 'REJECTED'],
    };
  },
  created() {
    this.getMembershipData();
  },
  methods: {
    async getMembershipData() {
      this.listLoading = true;
      const { data } = await membershipResource.list(this.listQuery);
      console.log('hihi');
      console.log(data);
      if (data[0].status !== 'NONE'){
        this.list = data[0].memberships.data;
        this.total = data[0].memberships.data.length;
      }
      this.listLoading = false;
      console.log(this.list);
    },
    review_application(id){
      this.$router.push({ path: '/membership/review/' + id }, onAbort => {});
    },
    handleFilter() {
      this.listQuery.page = 1;
      this.getMembershipData();
    },
    sortChange(data) {
      const { prop, order } = data;
      if (prop === 'id') {
        this.sortByID(order);
      }
    },
    sortByID(order) {
      if (order === 'ascending') {
        this.listQuery.sort = '+id';
      } else {
        this.listQuery.sort = '-id';
      }
      this.handleFilter();
    },
  },
};
</script>
