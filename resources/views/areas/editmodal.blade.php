<div class="modal fade" id="editAreaModal" tabindex="-1" role="dialog" aria-labelledby="editAreaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{route('area.update', ['area' => $area->id])}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAreaModalLabel">Edit Area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="code">Kode Area</label>
                                <input type="text" class="form-control" id="codeEdit" name="code" readonly
                                    value="{{ $area->code }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region_name">Nama Region</label>
                                <input required type="text" class="form-control" id="region_name_edit"
                                    name="region_name" value="{{ $area->region_name }}">
                            </div>
                            <div class="form-group">
                                <label for="province_name">Nama Provinsi</label>
                                <input required type="text" class="form-control" id="province_name_edit"
                                    name="province_name" value="{{ $area->province_name }}">
                            </div>
                            <div class="form-group">
                                <label for="city_name">Nama Kota/Kabupaten</label>
                                <input required type="text" class="form-control" id="city_name_edit" name="city_name"
                                    value="{{ $area->city_name }}">
                            </div>
                            <div class="form-group">
                                <label for="district_name">Nama Kecamatan</label>
                                <input required type="text" class="form-control" id="district_name_edit"
                                    name="district_name" value="{{ $area->district_name }}">
                            </div>
                            <div class="form-group">
                                <label for="village_name">Nama Desa/Kelurahan</label>
                                <input required type="text" class="form-control" id="village_name_edit"
                                    name="village_name" value="{{ $area->village_name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region_code">Kode Region</label>
                                <input required type="text" class="form-control" id="region_code_edit"
                                    name="region_code" value="{{ $area->region_code }}">
                            </div>
                            <div class="form-group">
                                <label for="province_code">Kode Provinsi</label>
                                <input required type="text" class="form-control" id="province_code_edit"
                                    name="province_code" value="{{ $area->province_code }}">
                            </div>
                            <div class="form-group">
                                <label for="city_code">Kode Kota/Kabupaten</label>
                                <input required type="text" class="form-control" id="city_code_edit" name="city_code"
                                    value="{{ $area->city_code }}">
                            </div>
                            <div class="form-group">
                                <label for="district_code">Kode Kecamatan</label>
                                <input required type="text" class="form-control" id="district_code_edit"
                                    name="district_code" value="{{ $area->district_code }}">
                            </div>
                            <div class="form-group">
                                <label for="village_code">Kode Kelurahan/Desa</label>
                                <input required type="text" class="form-control" id="village_code_edit"
                                    name="village_code" value="{{ $area->village_code }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>