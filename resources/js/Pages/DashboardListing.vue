<template>
  <DashboardLayout title="Listings">
    <div class="container mx-auto mt-20">
      <div class="card">
        <div class="card-body">
          <h4 class="heading hind-font medium-font-weight dashboard-title">All Listings</h4>
          <table class="table table-bordered" id="yajra_datatable">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center title-column">Name</th>
                <th class="text-center description-column">Description</th>
                <th class="text-center">Room Count</th>
                <th class="text-center">Bathroom Count</th>
                <th class="text-center">Guest Count</th>
                <th class="text-center">Price</th>
                <th class="text-center">State</th>
                <th class="text-center">Location</th>
                <th class="text-center">Category</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import { onMounted } from 'vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faEdit, faTrash } from '@fortawesome/free-solid-svg-icons';

library.add(faEdit, faTrash);

const endpoint = '/dashboard/listings';

onMounted(() => {
  $('#yajra_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: endpoint,
      type: 'GET',
    },
    columns: [
      { data: 'id', name: 'id', className: 'text-center' },
      { data: 'name', name: 'name', className: 'text-center title-column' },
      { data: 'description', name: 'description', className: 'text-center description-column' },
      { data: 'roomCount', name: 'roomCount', className: 'text-center' },
      { data: 'bathroomCount', name: 'bathroomCount', className: 'text-center' },
      { data: 'guestCount', name: 'guestCount', className: 'text-center' },
      { data: 'price', name: 'price', className: 'text-center' },
      { data: 'state', name: 'state', className: 'text-center' },
      { data: 'location', name: 'location', className: 'text-center' },
      { data: 'category', name: 'category', className: 'text-center' },
      { data: 'action', name: 'action', className: 'text-center' },
    ]
  });
  
});

$(document).on('click', '.btn-delete', function () {
    const id = $(this).data('id');
    if (confirm('Are you sure you want to delete this listing?')) {
        axios.delete(`/listings/${id}`)
            .then(response => {
                $('#yajra_datatable').DataTable().ajax.reload();
            })
            .catch(error => {
                alert('Error deleting listing: ' + (error.response.data.message || error.message));
            });
    }
});

</script>

<style scoped>
::v-deep .dataTables_wrapper {
  position: relative;
  padding-top: 3rem;
  padding-bottom: 3rem;
}

::v-deep #yajra_datatable_paginate {
  display: flex;
  gap: 10px;
}

::v-deep #yajra_datatable_paginate a {
  cursor: pointer;
}

::v-deep #yajra_datatable_paginate a:hover {
  color: #f73d76;
}

::v-deep #yajra_datatable_paginate span {
  display: flex;
  gap: 10px;
}

::v-deep #yajra_datatable_paginate span a {
  padding-left: 1rem;
  padding-right: 1rem;
  border: 1px solid black;
  border-radius: 50px;
  cursor: pointer;
  transition: transform 0.2s ease, background-color 0.2s ease, border-color 0.2s ease;
}

::v-deep #yajra_datatable_paginate span a:hover {
  background-color: #f73d76;
  color: white;
  transform: scale(1.1);
  border-color: #f73d76;
}

::v-deep select {
  border-radius: 50px;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

::v-deep select:focus {
  border-color: #f73d76;
  outline: none;
  box-shadow: 0 0 0 2px rgba(247, 61, 118, 0.5);
}

::v-deep input {
  border-radius: 50px;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

::v-deep input:focus {
  border-color: #f73d76;
  outline: none;
  box-shadow: 0 0 0 2px rgba(247, 61, 118, 0.5);
}

::v-deep #yajra_datatable_length {
  position: absolute;
  left: 0;
  top: 0;
  margin-bottom: 100px;
  padding: 0;
}

::v-deep #yajra_datatable_filter {
  position: absolute;
  right: 0;
  top: 0;
  margin: 0;
  padding: 0;
}

::v-deep .description-column {
  max-width: 15rem;
  word-wrap: break-word;
  white-space: normal;
}

::v-deep .title-column {
  max-width: 10rem;
  word-wrap: break-word;
  white-space: normal;
}

.container {
  max-width: 100%;
  overflow-x: auto;
}

.card {
  border: 1px solid #e0e0e0;
  border-radius: 0.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 0.75rem;
  overflow-x: auto;
  white-space: nowrap;
}

.card-body {
  padding: 0;
  margin: 0;
  width: 100%;
}

.table {
  width: 100%;
  margin: auto;
  margin-bottom: 1rem;
  color: #212529;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
}

::v-deep td {
  height: 3rem;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 1px solid #e0e0e0;
}

.table tbody + tbody {
  border-top: 1px solid #e0e0e0;
}

.table-bordered th,
.table-bordered td {
  border-top: 1px solid #e0e0e0;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 1px;
}

::v-deep #yajra_datatable_info {
  position: absolute;
  left: 0;
  bottom: 0;
  margin: 0;
  padding: 0;
}

::v-deep #yajra_datatable_paginate {
  position: absolute;
  right: 0;
  bottom: 0;
  margin: 0;
  padding: 0;
}

@media (max-width: 768px) {
  ::v-deep .dataTables_wrapper {
    padding-top: 0;
    padding-bottom: 0;
  }

  ::v-deep #yajra_datatable_length,
  ::v-deep #yajra_datatable_filter {
    position: static;
    margin-bottom: 10px;
    text-align: left;
    width: 100%;
  }

  ::v-deep #yajra_datatable_info,
  ::v-deep #yajra_datatable_paginate {
    position: static;
    margin-top: 10px;
    text-align: center;
    justify-content: center;
    width: 100%;
  }

  ::v-deep .description-column {
    max-width: none;
    word-wrap: break-word;
    white-space: normal;
  }

  ::v-deep .title-column {
    max-width: none;
    word-wrap: break-word;
    white-space: normal;
  }
}
</style>
