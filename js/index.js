import 'ol/ol.css';
import {Map, View} from 'ol';
import TileLayer from 'ol/layer/Tile';
import OSM from 'ol/source/OSM';
import VectorLayer from 'ol/layer/Vector';
import VectorSource from 'ol/source/Vector';
import Feature from 'ol/Feature';
import * as proj from 'ol/proj';
import Point from 'ol/geom/Point';
import Style from 'ol/style/Style';
import Icon from 'ol/style/Icon';
import alfinete from '../icons/alfinete.png'

const lat = -27.0733424;
const long = -53.159837;

const map = new Map({
    target: 'map',
    layers: [
        new TileLayer({
            source: new OSM()
        }),

    ],
    view: new View({
        center: [lat, long],
        zoom: 16
    })
});

let styleMarker = [
    new Style({
        image: new Icon({
            scale: 0.022,
            src: alfinete,
        }),
        zIndex: 5,
    }),
];

let layer = new VectorLayer({
    source: new VectorSource({
        features: [
            new Feature({
                geometry: new Point(proj.fromLonLat([long, lat]))
            })
        ]
    })
});


// setar o centro
map.getView().setCenter(proj.transform([long, lat], 'EPSG:4326', 'EPSG:3857'));
// colocar estilo no marcador
layer.setStyle(styleMarker);
// adicionar o marcador, no caso o alfinete
map.addLayer(layer);
