<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

class ZoneController extends Controller
{
    public function zoneIndex()
    {
        $zones = Zone::where('status', 1)->get();
        return view('admin.zone.all', compact('zones'));
    }

    public function zoneCreate()
    {
        return view('admin.zone.add');
    }

    public function zoneStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:zones,name',
            'coordinates' => 'required',
        ]);

        try {
            $value = $request->coordinates;
            $decodedCoords = json_decode($value, true);
            $polygon = [];

            if (is_array($decodedCoords)) {
                $latSum = 0;
                $lngSum = 0;
                $count = 0;

                foreach ($decodedCoords as $coords) {
                    if (isset($coords['lat']) && isset($coords['lng'])) {
                        $lat = (float) $coords['lat'];
                        $lng = (float) $coords['lng'];

                        $polygon[] = new Point($lat, $lng);

                        $latSum += $lat;
                        $lngSum += $lng;
                        $count++;
                    }
                }

                // Close the polygon if not closed
                if (!empty($polygon) && $polygon[0] !== end($polygon)) {
                    $polygon[] = $polygon[0];
                }

                // Calculate center point (centroid)
                $centerLat = $count > 0 ? $latSum / $count : 0;
                $centerLng = $count > 0 ? $lngSum / $count : 0;

                $result = Zone::create([
                    'name' => $request->name,
                    'coordinates' => new Polygon([new LineString($polygon)]),
                    'center' => new Point($centerLat, $centerLng),
                ]);
            }

            if (!empty($result)) {
                $request->session()->flash('modal-success', 'Zone created successfully.');
            } else {
                $request->session()->flash('modal-danger', 'Invalid coordinates format.');
            }

        } catch (\Exception $ex) {
            $request->session()->flash('modal-danger', 'Exception: ' . $ex->getMessage());
        }
    }

    public function zoneUpdateStatus(Request $request, $zoneId)
    {
        $zone = Zone::findOrFail($zoneId);
        $zone->status = $request->status ? 1 : 0;
        if ($zone->save()) {
            $request->session()->flash('modal-success', 'Zone Status Updated Successfully');
        } else {
            $request->session()->flash('modal-danger', 'Something Went Wrong');
        }
    }

    public function zoneEdit($zoneId)
    {
        $zone = Zone::selectRaw("*,ST_AsText(ST_Centroid(`coordinates`)) as center")->findOrFail($zoneId);
        $area = json_decode($zone->coordinates[0]->toJson(), true);
        return view('admin.zone.edit', compact('zone', 'area'));
    }

    public function zoneUpdate(Request $request)
    {
        $zone = Zone::findOrFail($request->zoneId);

        $request->validate([
            'name' => ['required', 'string', Rule::unique('zones')->ignore($zone->id)],
            'coordinates' => 'required',
        ]);

        try {
            $value = $request->coordinates;
            $decodedCoords = json_decode($value, true);
            $polygon = [];

            if (is_array($decodedCoords)) {
                $latSum = 0;
                $lngSum = 0;
                $count = 0;

                foreach ($decodedCoords as $coords) {
                    if (isset($coords['lat']) && isset($coords['lng'])) {
                        $lat = (float) $coords['lat'];
                        $lng = (float) $coords['lng'];

                        // IMPORTANT: MySQL POINT takes (lng, lat)
                        $polygon[] = new Point($lat, $lng);

                        $latSum += $lat;
                        $lngSum += $lng;
                        $count++;
                    }
                }

                // Close the polygon if not closed
                if (!empty($polygon) && $polygon[0] !== end($polygon)) {
                    $polygon[] = $polygon[0];
                }

                // Calculate centroid
                $centerLat = $count > 0 ? $latSum / $count : 0;
                $centerLng = $count > 0 ? $lngSum / $count : 0;

                // Update zone fields
                $zone->name = $request->name;
                $zone->coordinates = new Polygon([new LineString($polygon)]);
                $zone->center = new Point($centerLat, $centerLng);
            }

            if ($zone->save()) {
                $request->session()->flash('modal-success', 'Zone updated successfully.');
            } else {
                $request->session()->flash('modal-danger', 'Invalid coordinates format.');
            }

        } catch (\Exception $ex) {
            $request->session()->flash('modal-danger', 'Exception: ' . $ex->getMessage());
        }
    }

    public function zoneDelete(Request $request, $zoneId)
    {
        try {
            $zone = Zone::findOrFail($zoneId);
            if ($zone->delete()) {
                $request->session()->flash('modal-success', 'Zone deleted successfully.');
            } else {
                $request->session()->flash('modal-danger', 'Zone deletion failed.');
            }
        } catch (\Exception $e) {
            $request->session()->flash('modal-danger', 'Exception: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function zoneShow($zoneId)
    {
        $zone = Zone::selectRaw("*,ST_AsText(ST_Centroid(`coordinates`)) as center")->findOrFail($zoneId);
        $area = json_decode($zone->coordinates[0]->toJson(), true);
        return view('admin.zone.view', compact('zone', 'area'));
    }
}
