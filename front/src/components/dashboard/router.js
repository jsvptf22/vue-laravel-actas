import PHome from "./home/PHome";
import PDocumentBuilder from "./documentBuilder/PDocumentBuilder";
import PDocumentBuilderRoutes from "./documentBuilder/router.js";

const PDashboardRoutes = [
    {
        path: '/document',
        component: PDocumentBuilder,
        children: PDocumentBuilderRoutes
    }, {
        path: '/home',
        component: PHome
    }, {
        path: '',
        component: PHome
    }
];

export default PDashboardRoutes;