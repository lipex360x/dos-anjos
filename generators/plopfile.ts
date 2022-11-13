import { NodePlopAPI } from 'plop'
import modules from './modules'

export default function (plop: NodePlopAPI) {
  plop.setGenerator('Module', modules)
}