type UsePushFilesProps = {
  path: string
  name: string
  template: string
  force?: boolean
}

const usePushFiles = () => {
  const pushFile = ({
    name,
    path,
    template,
    force = true,
  }: UsePushFilesProps) => ({
    path,
    name,
    template,
    force,
  })

  return { pushFile }
}

export default usePushFiles