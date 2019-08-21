import PHome from "./home/PHome";
import PDocumentBuilder from "./documentBuilder/PDocumentBuilder";

const PDashboardRoutes = [
    {
        path: '/document',
        component: PDocumentBuilder
    }, {
        path: '/home',
        component: PHome
    }, {
        path: '',
        component: PHome
    }
];

export default PDashboardRoutes;