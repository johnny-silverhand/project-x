import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import * as am4plugins from "@amcharts/amcharts4/plugins/sunburst";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

const pageUrl = `/index.php?r=institution/view&id=`;
const render = () => {
  const wrapper = document.querySelector("#chart");
  am4core.addLicense("ch-custom-attribution");

  var chart = am4core.create(wrapper, am4plugins.Sunburst);
  chart.padding(0, 0, 0, 0);
  chart.radius = am4core.percent(90);
  chart.radius.width = 100 % am4core.useTheme(am4themes_animated);

  chart.data = window.dashboardData || [];
  chart.colors.step = 2;
  chart.fontSize = 11;
  chart.innerRadius = am4core.percent(10);

  // define data fields
  chart.dataFields.value = "value";
  chart.dataFields.name = "name";
  chart.dataFields.children = "children";
  chart.dataFields.id = "id";

  var level0SeriesTemplate = new am4plugins.SunburstSeries();
  level0SeriesTemplate.hiddenInLegend = false;
  chart.seriesTemplates.setKey("0", level0SeriesTemplate);

  // this makes labels to be hidden if they don't fit
  level0SeriesTemplate.labels.template.truncate = true;
  level0SeriesTemplate.labels.template.hideOversized = true;
  level0SeriesTemplate.slices.template.cursorOverStyle =
    am4core.MouseCursorStyle.pointer;
  level0SeriesTemplate.tooltip.width = 320;
  level0SeriesTemplate.tooltip.label.wrap = true;

  level0SeriesTemplate.labels.template.adapter.add(
    "rotation",
    function (rotation, target) {
      target.maxWidth =
        target.dataItem.slice.radius - target.dataItem.slice.innerRadius - 10;
      target.maxHeight = Math.abs(
        ((target.dataItem.slice.arc *
          (target.dataItem.slice.innerRadius + target.dataItem.slice.radius)) /
          2) *
          am4core.math.RADIANS
      );
      level0SeriesTemplate.labels.template.truncate = true;
      level0SeriesTemplate.labels.template.maxWidth = 150;
      return rotation;
    }
  );

  level0SeriesTemplate.labels.template.fontSize = 11;

  var level1SeriesTemplate = level0SeriesTemplate.clone();
  chart.seriesTemplates.setKey("1", level1SeriesTemplate);
  level1SeriesTemplate.fillOpacity = 0.75;
  level1SeriesTemplate.hiddenInLegend = true;

  var level2SeriesTemplate = level0SeriesTemplate.clone();
  chart.seriesTemplates.setKey("2", level2SeriesTemplate);
  level2SeriesTemplate.fillOpacity = 0.5;
  level2SeriesTemplate.hiddenInLegend = true;

  chart.legend = new am4charts.Legend();
  chart.legend.position = "right";
  chart.legend.labels.template.truncate = true;

  level0SeriesTemplate.slices.template.events.on("hit", (e) => {
    window.location.href = pageUrl + e.target.dataItem.dataContext.id;
  });
};

export const mainChartInit = () => {
  am4core.ready(() => {
    render();
  });
};
