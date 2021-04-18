import $ from 'jquery';
import {mainChartInit} from "./mainChart";

const mainChartElement = document.querySelector('#chart');


mainChartElement?mainChartInit():null;
