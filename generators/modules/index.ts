const COMPONENT_PATH = '../src/modules'
import usePushFiles from './hooks/usePushFiles'

export default {
  description: 'Generate a Module',
  
  prompts: [
    {
      type: 'input',
      name: 'moduleName',
      message: 'Module Name',
      validate: (value: string) => {
        if (!value) return 'Value is required'
        return true
      },
    },
  ],

  actions: (data: any) => {
    const { pushFile } = usePushFiles()
    const pathTemplate = './modules/templates'
    const componentPath = COMPONENT_PATH +'/{{moduleName}}'

    const files = () => {
      const arrayFiles = []

      arrayFiles.push(
        pushFile({
          path: `${componentPath}`,
          template: 'indexModule.hbs',
          name: 'index.php',
        }),
      )

      // Entity
      arrayFiles.push(
        pushFile({
          path: `${componentPath}/infra/entities`,
          template: 'indexEntity.hbs',
          name: 'index.php',
        }),
      )

      arrayFiles.push(
        pushFile({
          path: `${componentPath}/infra/entities`,
          template: 'entity.hbs',
          name: '{{pascalCase moduleName}}.entity.php',
        }),
      )

      // Repository
      arrayFiles.push(
        pushFile({
          path: `${componentPath}/infra/repositories`,
          template: 'indexRepository.hbs',
          name: 'index.php',
        }),
      )

      arrayFiles.push(
        pushFile({
          path: `${componentPath}/infra/repositories`,
          template: 'repository.hbs',
          name: '{{pascalCase moduleName}}.repository.php',
        }),
      )
      
      // Controller
      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/controllers`,
          template: 'indexController.hbs',
          name: 'index.php',
        }),
      )

      // UseCases
      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/useCases`,
          template: 'indexUseCase.hbs',
          name: 'index.php',
        }),
      )

      // Create UseCase     
      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/controllers`,
          template: 'createController.hbs',
          name: 'Create{{pascalCase moduleName}}.controller.php',
        }),
      )

      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/useCases`,
          template: 'createUseCase.hbs',
          name: 'Create{{pascalCase moduleName}}.useCase.php',
        }),
      )

      // List UseCase     
      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/controllers`,
          template: 'listController.hbs',
          name: 'List{{pascalCase moduleName}}.controller.php',
        }),
      )

      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/useCases`,
          template: 'listUseCase.hbs',
          name: 'List{{pascalCase moduleName}}.useCase.php',
        }),
      )

      // Show UseCase
      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/controllers`,
          template: 'showController.hbs',
          name: 'Show{{pascalCase moduleName}}.controller.php',
        }),
      )

      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/useCases`,
          template: 'showUseCase.hbs',
          name: 'Show{{pascalCase moduleName}}.useCase.php',
        }),
      )

      // Update UseCase
      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/controllers`,
          template: 'updateController.hbs',
          name: 'Update{{pascalCase moduleName}}.controller.php',
        }),
      )

      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/useCases`,
          template: 'updateUseCase.hbs',
          name: 'Update{{pascalCase moduleName}}.useCase.php',
        }),
      )

      // Delete UseCase
      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/controllers`,
          template: 'deleteController.hbs',
          name: 'Delete{{pascalCase moduleName}}.controller.php',
        }),
      )

      arrayFiles.push(
        pushFile({
          path: `${componentPath}/application/useCases`,
          template: 'deleteUseCase.hbs',
          name: 'Delete{{pascalCase moduleName}}.useCase.php',
        }),
      )

      return arrayFiles
    }

    const action = [] as any

    files().forEach((file) => {
      const createFile = {
        type: 'add',
        path: `${file.path}/${file.name}`,
        templateFile: `${pathTemplate}/${file.template}`,
        force: false,
      }

      action.push(createFile)
    })

    const updateFile = {
      type: 'append',
      path: `${COMPONENT_PATH}/index.php`,
      template: "require_once('{{moduleName}}/index.php');",
    }
    action.push(updateFile)

    return action
  }
}